<?php

namespace App\Livewire\File;

use App\Mail\ApprovalFile;
use App\Mail\ShareFile;
use App\Models\File;
use App\Models\FileShare;
use App\Models\Folder;
use App\Models\UserGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Index extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Url]

    public $uuid;
    public $tags = [];
    public $file, $folder, $ancestors, $another_version_files = [], $user_groups;
    public $open_form_upload, $upload_file, $emailLists = [], $invited_emails, $email;

    // Modal share
    public $share_by_email_group, $share_by_email_role, $share_by_email_expiration, $share_by_email_expires_at;
    public $share_by_link, $share_by_link_id, $share_by_link_expiration, $share_by_link_expires_at, $share_by_link_role = 'Download';

    // Modal approval
    public $approval_resolution, $approval_invited_emails, $approval_by_email_expiration, $approval_by_email_expires_at;

    public $curent_link;

    protected $rules =  ['qty' => 'array', 'qty.*' => 'numeric'];

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        $this->file = File::find($this->uuid);
        $this->folder = Folder::find($this->file->folder_id);
        $this->ancestors = $this->folder->joinAncestors()->reverse();
        $this->user_groups = UserGroup::get();

        $file_share = FileShare::where('file_id', $this->uuid)->whereNotNull('by_link');
        if ($file_share->count()) {
            $file_share_data = $file_share->first();

            $this->share_by_link = $file_share_data->by_link ? true : false;
            $this->share_by_link_id = $file_share_data->by_link ? $file_share_data->id : null;
            $this->share_by_link_expiration = $file_share_data->expires_at ? true : null;
            $this->share_by_link_expires_at = $file_share_data->by_link ? $file_share_data->expires_at : null;
            $this->share_by_link_role = $file_share_data->by_link ? $file_share_data->role : null;
            // dd($file_share_data);
        }
    }

    public function lock_file()
    {
        DB::beginTransaction();
        $this->file->update(['lock_status' => 1]);

        $text = " Locked";
        $this->file->newActivity($this->file->id, $text);
        DB::commit();

        $this->flash('success', 'File locked!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ], $this->curent_link);
    }

    public function unlock_file()
    {
        DB::beginTransaction();
        $this->file->update(['lock_status' => 0]);

        $text = " Unlocked";
        $this->file->newActivity($this->file->id, $text);
        DB::commit();

        $this->flash('success', 'File unlocked!', [
            'position' => 'top-end',
            'timer' => 3000,
            'toast' => true,
            'timerProgressBar' => true,
        ], $this->curent_link);
    }

    public function updateUploadFiles($val)
    {
        $this->open_form_upload = $val;
    }

    public function updatedUploadFile()
    {
        DB::beginTransaction();

        $file_name = $this->upload_file->getClientOriginalName();

        // $this->file = Document::findOrFail($request->id);
        // $this->file->update(['name' => $file_name]);

        $this->file->attachments()->insert([
            'id' => Str::orderedUuid(),
            'name' => $file_name,
            'file' => '/uploads/' . $this->file->id . '/' . $file_name,
            'file_id' => $this->file->id,
            'created_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $upload = Storage::disk('public')->putFileAs('uploads/' . $this->file->id . '/', $this->upload_file, $file_name);

        $text = $file_name . " is Updated To " . ' : <a href="' . route('file.index') . '?uuid=' . $this->uuid . '">' . $this->file->name . "</a>";
        $this->file->newActivity($this->file->id, $text);
        // dd($this->file->activities);

        DB::commit();

        // return redirect($request->curent_link);

        // $file_name = $file->getClientOriginalName();
        // $file_ext = $file->getClientOriginalExtension();

        // $newFile = new File();

        // $newFile->name = $file_name;
        // $newFile->folder_id = $this->uuid;
        // $newFile->status = 'PENDING';
        // $newFile->lock_status = NULL;
        // $newFile->created_by = Auth::id();
        // $newFile->save();

        // // dd($newFile);
        // $newFile->attachments()->insert([
        //     'id' => Str::orderedUuid(),
        //     'file_id' => $newFile->id,
        //     'name' => $file_name,
        //     'file' => "/uploads/$newFile->id/$file_name",
        //     'created_by' => Auth::id()
        // ]);

        // $text = "Uploaded to " . $this->folder->name . ' : <a href="' . route('file.index') . '?uuid=' . $this->uuid . '">' . $newFile->name . "</a>";
        // $newFile->newActivity($newFile->id, $text);

        // $upload = Storage::disk('public')->putFileAs('uploads/' . $newFile->id . '/', $file, $file_name);

        DB::commit();
    }

    public function share_by_email()
    {
        try {
            if (!$this->share_by_email_group) {
                $this->validate([
                    'invited_emails' => 'required|min:5',
                ]);
                $invited_emails = explode(',', $this->invited_emails);
            } else {
                $this->validate([
                    'share_by_email_group' => 'required',
                    'share_by_email_role' => 'required|in:Preview,Viewer,Editor',
                ]);
                $group = UserGroup::findOrFail($this->share_by_email_group)->emails;
                $invited_emails = $group ? explode(',', $group) : 0;
            }

            if ($invited_emails) {

                DB::beginTransaction();
                foreach ($invited_emails as $email) {
                    $share = new FileShare();
                    $share->file_id = $this->file->id;
                    $share->email = $email;
                    $share->role = $this->share_by_email_role;
                    $share->expires_at = $this->share_by_email_expires_at ? Carbon::parseFromLocale($this->share_by_email_expires_at) : NULL;
                    $share->save();

                    $data = [
                        'subject' => 'Share Document',
                        'title' => 'Share Document',
                        'body' => 'Body',
                        'document_name' => $this->file->name,
                        'file_name' => $this->file->name,
                        'share_id' => $share->id,
                    ];

                    Mail::to($email)->send(new ShareFile($data));

                    $text = "Shared to $email as $this->share_by_email_role";
                    $this->file->newActivity($this->file->id, $text);
                }

                DB::commit();
            }

            $this->flash('success', 'Share via email berhasil!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
            // return redirect($this->curent_link);
        } catch (\Throwable $th) {

            $this->flash('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ], $this->curent_link);
        }
    }

    public function updatedShareByLink()
    {
        try {
            if ($this->share_by_link) {

                DB::beginTransaction();

                $share = new FileShare();
                $share->file_id = $this->file->id;
                $share->by_link = $this->share_by_link;
                $share->role = $this->share_by_link_role;
                $share->expires_at = $this->share_by_link_expires_at ? Carbon::parseFromLocale($this->share_by_link_expires_at) : NULL;
                $share->save();

                $text = "Created a public share link";
                $this->file->newActivity($this->file->id, $text);

                $this->share_by_link_id = $share->id;

                DB::commit();
            }
        } catch (\Throwable $th) {

            $this->flash('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ], $this->curent_link);
        }
    }

    public function updatedShareByLinkRole()
    {

        // DB::beginTransaction();

        // $share = new FileShare();
        // $share->file_id = $this->file->id;
        // $share->by_link = $this->share_by_link;
        // $share->role = $this->share_by_link_role;
        // $share->expires_at = $this->share_by_link_expires_at ? Carbon::parseFromLocale($this->share_by_link_expires_at) : NULL;
        // $share->save();

        // $text = "Created a public share link";
        // $this->file->newActivity($this->file->id, $text);

        // $this->share_by_link_id = $share->id;
        // dd($share);

        // DB::commit();
    }

    public function updatedShareByLinkExpiresAt()
    {
        // dd($this->share_by_link_expires_at);
    }


    public function start_approval()
    {
        try {
            $this->validate([
                'approval_invited_emails' => 'required|min:5',
            ]);

            $invited_emails = explode(',', $this->invited_emails);

            if ($invited_emails) {

                DB::beginTransaction();
                foreach ($invited_emails as $email) {
                    // $share = new FileShare();
                    // $share->file_id = $this->file->id;
                    // $share->email = $email;
                    // $share->role = $this->share_by_email_role;
                    // $share->expires_at = $this->share_by_email_expires_at ? Carbon::parseFromLocale($this->share_by_email_expires_at) : NULL;
                    // $share->save();

                    $data = [
                        'subject' => 'Share Document',
                        'title' => 'Share Document',
                        'body' => 'Body',
                        'document_name' => $this->file->name,
                        'file_name' => $this->file->name,
                        'share_id' => $this->file->id,
                        // 'share_id' => $share->id,
                    ];

                    Mail::to($email)->send(new ApprovalFile($data));

                    $text = "Shared to $email as $this->share_by_email_role";
                    $this->file->newActivity($this->file->id, $text);
                }

                DB::commit();
            }

            $this->flash('success', 'Share via email berhasil!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
        } catch (\Throwable $th) {

            $this->flash('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ], $this->curent_link);
        }
    }

    public function addSpare($spareId)
    {
        $this->validate();

        $this->job->spares()->attach($spareId, ['qty' => $this->qty[$spareId]]);

        // return Redirect::route('jobs.edit', ['job'=>$this->job, 'selectedTab'=>'#tab2');
    }

    public function render()
    {
        return view('livewire.file.index');
    }
}
