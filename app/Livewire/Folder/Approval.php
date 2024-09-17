<?php

namespace App\Livewire\Folder;

use App\Models\Folder;
use App\Models\FolderApproval;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Url;

class Approval extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Url]

    public $id;
    public $approval, $approval_comment, $approval_file;
    public $approvals;

    public $curent_link;

    public function mount()
    {
        $this->curent_link = Request::url();

        $this->approval = FolderApproval::findOrFail($this->id);
        $this->approval_comment = $this->approval->comment;
        $this->approval_file = $this->approval->file;
        $this->approvals = FolderApproval::where('folder_id', $this->approval->folder_id)->get();
        // dd($this->approvals);
    }

    public function store($status)
    {
        try {
            DB::beginTransaction();
            if ($status == 'Approved' || $status == 'Rejected') {
                if ($this->approval_file) {
                    $file_name = $this->approval_file->getClientOriginalName();
                    $upload = Storage::disk('public')->putFileAs('resolution/' . $this->approval->id . '/', $this->approval_file, $file_name);
                } else {
                    $file_name = null;
                }

                $approval = $this->approval;
                $approval->comment = $this->approval_comment;
                $approval->file = $file_name;
                $approval->status = $status;
                $approval->save();
                // dd($this->approval);
                $this->SetMainStatus($status);

                $approval->folder->activities()->create([
                    'activity' => $status . " the document",
                    'created_by' => Auth::id(),
                    'folder_id' => $approval->folder_id,
                ]);
            }
            // dd('stop');
            DB::commit();
            $this->flash('success', 'Your approval saved successfuly!', [
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

    public function SetMainStatus($selected_status)
    {
        DB::beginTransaction();

        $fa = FolderApproval::where('folder_id', $this->approval->folder_id);

        $count_wa = $fa->where('status', 'Waiting Approval')->count();
        if (!$count_wa) {
            $count_a = $fa->where('status', 'Approved')->count();
            $count_r = $fa->where('status', 'Rejected')->count();

            $status = $count_r > 0 ? 'Rejected' : ($selected_status == 'Rejected' ? 'Rejected' : $selected_status);
            // $status = $fa->count() > 1 ? (($count_r >= $count_a) ? 'Rejected' : 'Approved') : $selected_status;

            $folder = $this->approval->folder;
            $folder->approval_status = $status;
            $folder->save();

            if ($folder->files) {
                foreach ($folder->files as $key => $file) {
                    $file->approval_status = $status;
                    $file->save();
                }
            }
        }
        // dd($folder);
        DB::commit();

        // $fol
    }

    public function render()
    {
        return view('livewire.folder.approval')->layout('livewire.layouts.public');
    }
}
