<?php

namespace App\Livewire\Folder;

use App\Models\Folder;
use App\Models\FolderApproval;
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
    public $approval;
    public $approvals;

    public $curent_link;

    public function mount()
    {
        $this->curent_link = Request::url();

        $this->approval = FolderApproval::findOrFail($this->id);
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

    public function render()
    {
        return view('livewire.folder.approval')->layout('livewire.layouts.public');
    }
}
