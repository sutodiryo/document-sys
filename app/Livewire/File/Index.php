<?php

namespace App\Livewire\File;

use App\Mail\ApprovalFile;
use App\Mail\ShareFile;
use App\Models\Attachment;
use App\Models\File;
use App\Models\FileShare;
use App\Models\Folder;
use App\Models\UserGroup;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
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

// use setasign\Fpdi\Fpdi;
use setasign\Fpdi\Tcpdf\Fpdi;
use Illuminate\Support\Facades\Http;

class Index extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Url]

    public $uuid;
    public $tags = [];
    public $file, $folder, $ancestors, $another_version_files = [], $user_groups, $link_file;
    public $open_form_upload, $upload_file, $emailLists = [], $invited_emails, $email;
    public $restore_attachment_id;

    // Modal share
    public $share_by_email_group, $share_by_email_role, $share_by_email_expiration, $share_by_email_expires_at;
    public $share_by_link, $share_by_link_id, $share_by_link_expiration, $share_by_link_expires_at, $share_by_link_role = 'Download';

    // Modal approval
    public $approval_resolution, $approval_invited_emails, $approval_by_email_expiration, $approval_by_email_expires_at;

    // Modal ESign
    public $esign_x = 400, $esign_y = 700, $esign_signature_option = 0, $esign_signature_file, $esign_signature_file_url;

    public $curent_link;

    protected $rules =  ['qty' => 'array', 'qty.*' => 'numeric'];
    protected $listeners = ['cancelDelete', 'confirmFileDelete', 'confirmAttachmentRestore'];

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        $this->file = File::find($this->uuid);
        $this->folder = Folder::find($this->file->folder_id);
        $this->ancestors = $this->folder->joinAncestors()->reverse();
        $this->user_groups = UserGroup::get();

        $this->link_file = route('public.ext.preview.files', $this->uuid);
        // $this->link_file = route('home') . Storage::url('uploads/' . $this->file->id . '/' . $this->file->attachment->name . '.' . $this->file->attachment->file_type);

        // $this->link_file = "http://writing.engr.psu.edu/workbooks/formal_report_template.doc";

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

    public function downloadZip()
    {
        dd('oke');
    }

    public function updatedUploadFile()
    {
        DB::beginTransaction();

        // $file_name = str_replace(' ', '_', $this->upload_file->getClientOriginalName());

        $name = pathinfo($this->upload_file->getClientOriginalName(), PATHINFO_FILENAME);
        $file_name = str_replace(' ', '_', $name);

        $file_ext = $this->upload_file->getClientOriginalExtension();
        $file_size = $this->upload_file->getSize();

        // $this->file = Document::findOrFail($request->id);
        // $this->file->update(['name' => $file_name]);

        $id = Str::orderedUuid();
        $this->file->attachments()->insert([
            'id' => $id,
            'name' => $file_name,

            'file_type' => $file_ext,
            'file_size' => $file_size,
            'path' => '/uploads/' . $this->file->id . '/',

            'file' => '/uploads/' . $this->file->id . '/' . $file_name,
            'file_id' => $this->file->id,
            'created_by' => Auth::id(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        $text = $file_name . " is Updated To " . ' : <a href="' . route('file.index') . '?uuid=' . $this->uuid . '">' . $this->file->name . "</a>";
        $this->file->newActivity($this->file->id, $text);
        // dd($this->file->activities);


        $upload = Storage::disk('public')->putFileAs('uploads/' . $this->file->id . '/', $this->upload_file, $file_name);

        if ($upload && ($file_ext == 'pdf' || $file_ext == 'PDF' || $file_ext == 'doc' || $file_ext == 'docx' || $file_ext == 'xls' || $file_ext == 'xlsx' || $file_ext == 'pps' || $file_ext == 'ppsx' || $file_ext == 'ppt' || $file_ext == 'pptx')) {

            $file = File::find($id);
            $path = storage_path('app/public/');

            ConvertApi::setApiCredentials('secret_6QN4WQBvAUZrCAfO');
            $result = ConvertApi::convert(
                'jpg',
                [
                    'File' => $path . $file->attachment->file,
                ],
                $file->attachment->file_type
            );
            $result->saveFiles($path . $file->attachment->path);
        }

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

    public function restoreVersion($id)
    {
        $attachment = Attachment::findOrFail($id);
        $this->restore_attachment_id = $id;

        $this->alert('question', '', [
            'title' => 'Anda yakin akan mengembalikan file ke versi ini ?',
            'text' => $attachment->name,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Ya, kembalikan',
            'showCancelButton' => true,
            'onConfirmed' => 'confirmAttachmentRestore',
            // 'onDismissed' => 'cancelAttachmentRestore',
            'cancelButtonText' => 'Tidak, Batalkan',
            'position' => 'center',
            'toast' => false,
            'timer' => null,
        ]);

        // Warning
        // update file to this attachment version

        // dd($attachment);
    }

    public function confirmAttachmentRestore()
    {
        DB::beginTransaction();
        $attactment = Attachment::findOrFail($this->restore_attachment_id);
        // $file = Attachment::withTrashed()->findOrFail($this->restore_attachment_id);
        $attactment->updated_at = Carbon::now();

        $text = "Restore attactment to " . $attactment->name;
        $this->file->newActivity($this->file->id, $text);

        DB::commit();

        $this->flash('success', 'File berhasil di kembalikan.', [], $this->curent_link);
    }

    public function downloadAttachment($id)
    {
        $attachment = Attachment::findOrFail($id);
        dd($attachment);
    }

    public function deleteAttachment($id)
    {
        $attachment = Attachment::findOrFail($id);

        $this->alert('question', '', [
            'title' => 'Anda yakin akan menghapus file ini ?',
            'text' => $attachment->name,
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
        dd($attachment);
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

    public function eSign()
    {
        $pdf = new FPDI('P', 'mm', 'A4');
        // dd(storage_path('app/public/') . 'uploads/' . $this->file->id . '/' . $this->file->attachment->name);
        $pages = $pdf->setSourceFile(storage_path('app/public/') . 'uploads/' . $this->file->id . '/' . $this->file->attachment->name);

        $certificate = 'file:/' . storage_path('app/public/') . 'document-sys.test.crt';

        $certificate = storage_path('app/public/') . 'host.cert';
        $certificateKey = storage_path('app/public/') . 'host.key';
        $prepend = "file://";
        // dd($certificate);
        // set additional information
        $info = array(
            'Name' => 'TCPDF',
            'Location' => 'Office',
            'Reason' => 'Testing TCPDF',
            'ContactInfo' => 'http://www.tcpdf.org',
        );

        for ($i = 1; $i <= $pages; $i++) {
            $pdf->AddPage();
            $page = $pdf->importPage($i);
            $pdf->useTemplate($page, 0, 0);
            // set document signature
            $pdf->setSignature($prepend . $certificate, $prepend . $certificateKey, 'tcpdfdemo', '', 2, $info);
        }

        $pdf->Output();
        // dd($pdf);
    }

    public function updatedEsignSignatureFile()
    {
        $this->esign_signature_file_url = route('public.tmp.preview.files', $this->esign_signature_file->getFileName());
        // dd($this->esign_signature_file_url);

    }

    public function eSignPDFCo()
    {
        $base_url = ENV('APP_URL');
        $this->esign_signature_file_url = $this->esign_signature_file_url ? $this->esign_signature_file_url : $base_url . '/signature.png';
        // dd($this->esign_signature_file_url);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-api-key' => 'yoxgii@gmail.com_SdM3oNfwdBEG9dP3QxRYqkRNMzTbZ5f1B7gaPdWQFaWbjWwxu7QdsRTsgMBQbQfd'
        ])->post('https://api.pdf.co/v1/pdf/edit/add', [
            'async' => false,
            'inline' => true,
            'name' => 'Signed_' . $this->file->name,
            'url' => route('public.ext.preview.files', $this->uuid),
            'images' => [
                [
                    'url' => $this->esign_signature_file_url,
                    'x' => $this->esign_x,
                    'y' => $this->esign_y,
                    'width' => 140,
                    // 'height' => 40,
                    'pages' => '0'
                ]
            ],
        ]);

        $response = json_decode($response->getBody()->getContents());

        return redirect($response->url);
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
