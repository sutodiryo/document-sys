<?php

namespace App\Livewire\Folder;

use App\Mail\StartAutomatedApproval;
use App\Models\File;
use App\Models\Folder;
use App\Models\UserGroup;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\Attributes\Validate;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use ZipArchive;

class Index extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Url]

    public $uuid;
    public $query;
    public $countSize, $countData, $limit, $latestUpdate, $obj;
    public $itemSelected = [], $countSelected, $sortSelected, $selected_folder_id, $selected_file_id;
    public $tags = [];
    public $folders = [], $folder, $ancestors;
    public $files = [], $delete_id;
    public $open_form_upload, $upload_files = [];

    public $user_groups, $approval_group, $resolution_status, $approval_resolution, $approval_invited_emails;
    public $retention_status = 'Active', $retention_date_end, $retention_action = 'Move to Recycle Bin';

    public $folder_name, $curent_link;

    protected $listeners = ['cancelDelete', 'confirmFileDelete'];

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        $folders = Folder::where('parent_id', $this->uuid);
        $this->folders = $folders->orderBy('created_at')->get();
        $last = $folders->latest()->first();
        $this->latestUpdate = 'Update on ' . Carbon::parse($last->updated_at ?? null)->format('F d, Y . H:i A');

        $this->folder = Folder::find($this->uuid);
        $this->ancestors = $this->folder->joinAncestors()->reverse();

        $files = File::where('folder_id', $this->uuid);
        $this->files = $files->orderBy('created_at')->get();

        $this->user_groups = UserGroup::get();

        $this->countSize = $files->count();
        $this->countData = $folders->count() + $files->count();
        $this->limit = $this->countData ? $this->countData : 0;
    }
    public function updateUploadFiles($val)
    {
        $this->open_form_upload = $val;
    }

    public function updatedUploadFiles()
    {
        // #[Validate('image|max:1024')]

        DB::beginTransaction();
        $files = [];
        foreach ($this->upload_files as $file) {
            $file_name = $file->getClientOriginalName();
            $file_ext = $file->getClientOriginalExtension();

            if ($file_ext == 'zip') {
                $this->uploadAndExtract($file, $file_name);
            } else {
                // dd('biasa');

                $newFile = new File();

                $newFile->name = $file_name;
                $newFile->folder_id = $this->uuid;
                $newFile->status = 'PENDING';
                $newFile->lock_status = NULL;
                $newFile->created_by = Auth::id();
                $newFile->save();

                // dd($newFile);
                $newFile->attachments()->insert([
                    'id' => Str::orderedUuid(),
                    'file_id' => $newFile->id,
                    'name' => $file_name,
                    'file' => "/uploads/$newFile->id/$file_name",
                    'created_by' => Auth::id()
                ]);

                $text = "Uploaded to " . $this->folder->name . ' : <a href="' . route('file.index') . '?uuid=' . $this->uuid . '">' . $newFile->name . "</a>";
                $newFile->newActivity($newFile->id, $text);

                $upload = Storage::disk('public')->putFileAs('uploads/' . $newFile->id . '/', $file, $file_name);

                DB::commit();
            }
        }
    }

    public function uploadAndExtract($file, $file_name)
    {
        $zipFilePath = $file->path();

        Storage::makeDirectory($file_name);

        $zip = new ZipArchive;

        if ($zip->open($zipFilePath) === True) {
            // $zip->extractTo(storage_path("uploads/$file_name"));
            // $upload = Storage::disk('public')->putFileAs('uploads/' . $newFile->id . '/', $file, $file_name);

            dd($zip);

            $zip->close();
        }
        dd($zip->open($zipFilePath));

        Storage::delete($zipFile->path());

        return to_route('dashboard')->with('message', 'File uploaded and extracted successfully');
    }

    public function delete()
    {
        foreach ($this->itemSelected as $item) {
            $folder = Folder::find($item);

            DB::beginTransaction();
            $folder->delete();
            dd($folder);
            DB::commit();
        }

        $this->dispatchBrowserEvent('swal', [
            'title' => 'Berhasil',
            'icon' => 'success',
            'text' => 'Data berhasil di hapus',
        ]);

        $this->emit('refreshComponent');

        $this->itemSelected = [];
        $this->countSelected = 0;
    }

    public function destroy_file($id, $permanent = false)
    {
        DB::beginTransaction();
        $file = File::withTrashed()->findOrFail($id);
        if ($permanent) {
            // $file->forceDelete();
            $text = "Permanent deleted file" . ' : <a href="#">' . $file->name . "</a>";
            $file->newActivity($file->id, $text);
        } else {
            $file->delete();
            $text = "Deleted file" . ' : <a href="' . route('file.index') . '?uuid=' . $this->uuid . '">' . $file->name . "</a>";
            $file->newActivity($file->id, $text);
        }
        dd($file->activities());
        DB::commit();

        return redirect()->route('doc.recycle-bin');
    }

    public function del_file($id)
    {
        $this->delete_id = $id;

        $file = File::withTrashed()->findOrFail($id);

        $this->alert('question', '', [
            'title' => 'Anda yakin akan menghapus file ini ?',
            'text' => $file->name,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, Hapus',
            'showCancelButton' => true,
            'onConfirmed' => 'confirmFileDelete',
            'onDismissed' => 'cancelDelete',
            'cancelButtonText' => 'Tidak, Batalkan',
            'position' => 'center',
            'toast' => false,
            'timer' => null,
        ]);
    }

    public function confirmFileDelete()
    {
        DB::beginTransaction();
        $file = File::withTrashed()->findOrFail($this->delete_id);
        $file->delete();
        $text = "Deleted file" . ' : <a href="' . route('file.index') . '?uuid=' . $this->delete_id . '">' . $file->name . "</a>";
        $file->newActivity($file->id, $text);

        // dd($file->activities());
        DB::commit();

        $this->flash('success', 'File berhasil dihapus.', [], $this->curent_link);
    }

    public function cancelDelete()
    {
        // $this->reset(['delete_id']);
        redirect($this->curent_link);
    }

    public function setModalFolderId($id)
    {
        $this->obj = 'folder';

        $folder = Folder::find($id);

        $this->selected_folder_id = $folder->id;
        $this->retention_date_end = $folder->active_until;
    }

    public function setModalFileId($id)
    {
        $this->obj = 'file';

        $file = File::find($id);

        $this->selected_file_id = $file->id;
        $this->retention_date_end = $file->active_until;
    }

    public function automated_workflow_store()
    {
        try {
            if (!$this->approval_group) {
                $this->validate([
                    'approval_invited_emails' => 'required|min:5',
                ]);
                $invited_emails = explode(',', $this->approval_invited_emails);
            } else {
                $this->validate([
                    'approval_group' => 'required',
                ]);
                $group = UserGroup::findOrFail($this->approval_group)->emails;
                $invited_emails = $group ? explode(',', $group) : 0;
            }

            if ($invited_emails) {

                DB::beginTransaction();
                $folder = Folder::find($this->selected_folder_id);
                $folder->approval_resolution = $this->approval_resolution;
                $folder->approval_status = 'Waiting Approval';
                $folder->save();

                if ($folder->files) {
                    foreach ($folder->files as $key => $file) {
                        $file->approval_resolution = $this->approval_resolution;
                        $file->approval_status = 'Waiting Approval';
                        $file->save();
                    }
                }
                // dd($folder->files);

                if ($this->resolution_status == 'Active') {

                    foreach ($invited_emails as $email) {
                        $approval = $folder->approvals()->create([
                            'folder_id' => $folder->id,
                            'email' => $email,
                            'status' => 'Waiting Approval'
                        ]);

                        $folder->activities()->create([
                            'activity' => "Start automated approval to $email",
                            'created_by' => Auth::id(),
                            'folder_id' => $this->selected_folder_id,
                        ]);

                        $data = [
                            'subject' => 'Document System has invited you to approve ' . '' . $folder->name . '',
                            'title' => 'Approval Document',
                            'body' => 'Body',
                            'id' => $approval->id,
                            'name' => $folder->name,
                            'resolution' => $this->approval_resolution,
                        ];

                        $mail = Mail::to($email)->send(new StartAutomatedApproval($data));
                    }
                } else {
                }
                DB::commit();
            }

            $this->flash('success', 'Automated approval started!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
        } catch (\Throwable $th) {

            $this->alert('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ]);
        }
    }

    public function retention_store()
    {
        try {
            $this->validate([
                'retention_date_end' => 'required',
            ]);

            $retention_date_end = Carbon::parse($this->retention_date_end);

            DB::beginTransaction();
            if ($this->retention_status == 'Active') {

                if ($this->obj == 'folder') {
                    $folder = Folder::find($this->selected_folder_id);
                    $folder->active_until = $retention_date_end;
                    $folder->save();

                    $folder->activities()->create([
                        'activity' => "Set retention conditions to: $this->retention_action at " . $retention_date_end->format('d m Y, h:i:s') . "",
                        'created_by' => Auth::id(),
                        'folder_id' => $this->selected_folder_id,
                    ]);
                } else {
                    $file = File::find($this->selected_file_id);
                    $file->active_until = $retention_date_end;
                    $file->save();

                    $file->activities()->create([
                        'activity' => "Set retention conditions to: $this->retention_action at " . $retention_date_end->format('d m Y, h:i:s') . "",
                        'created_by' => Auth::id(),
                        'file_id' => $this->selected_file_id,
                    ]);
                }
            }
            DB::commit();

            $this->flash('success', 'Retention updated!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
        } catch (\Throwable $th) {

            $this->alert('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ]);
        }
    }

    public function store()
    {
        try {
            $this->validate([
                'folder_name' => 'required',
            ]);

            DB::beginTransaction();

            $root = $this->folder;

            $child = new Folder();
            $child->name = $this->folder_name;
            $child->parent()->associate($root);
            $child->status = 1;
            $child->created_by = Auth::user()->id;
            $child->save();

            $child->newActivity($child->id, $child->name);

            DB::commit();

            $this->flash('success', 'Data berhasil di simpan!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
        } catch (\Throwable $th) {

            $this->alert('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ]);
        }
    }

    public function render()
    {
        return view('livewire.folder.index');
    }
}
