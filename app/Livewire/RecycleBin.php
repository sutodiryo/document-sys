<?php

namespace App\Livewire;

use App\Models\File;
use App\Models\Folder;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Url;

class RecycleBin extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Url]

    public $files, $folders;
    public $curent_link;

    public function mount()
    {
        $this->curent_link = Request::url();

        $this->files = File::onlyTrashed()->get();
        $this->folders = Folder::onlyTrashed()->get();
    }

    public function restore($id)
    {
        $file = File::withTrashed()->findOrFail($id);
        // $file->newActivity($file->id, $file->name, $this->folder->name);
        // $file->newActivity(ucfirst(config('settings.file_label_singular')) . " Restored");

        $text = "Restored folder" . ' : <a href="' . route('file.index') . '?uuid=' . $this->uuid . '">' . $file->name . "</a>";
        $file->newActivity($file->id, $text);

        $file->restore();
        return redirect()->route('doc.recycle-bin');
    }

    public function render()
    {
        return view('livewire.recycle-bin');
    }
}
