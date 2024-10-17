<?php

namespace App\Livewire\File;

use App\Models\Attachment;
use App\Models\File;
use Illuminate\Http\File as HttpFile;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use Livewire\Attributes\Url;

class View extends Component
{
    #[Url]

    public $uuid;
    public $file;
    public $spreadsheet;

    public $curent_link;
    public $link_file;

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        // $attachment = Attachment::where('file_id', $this->uuid)->latest()->first();
        // $path = storage_path('app/public/' . $attachment->file . '');

        $this->file = File::findOrFail($this->uuid);
        $this->link_file = route('home') . Storage::url('uploads/' . $this->file->id . '/' . $this->file->attachment->name);

        // $content = HttpFile::get($filename);
        // dd($path);
        // $reader = new Xlsx;
        // $reader->setReadDataOnly(true);
        // dd($reader);
        // $this->spreadsheet = $reader->load($path);
    }

    public function render()
    {
        return view('livewire.file.view')->layout('livewire.layouts.public');
    }
}
