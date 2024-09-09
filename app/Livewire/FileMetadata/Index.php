<?php

namespace App\Livewire\FileMetadata;

use App\Models\FileMetadata;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Index extends Component
{

    use LivewireAlert;

    public $metadatas;
    public $curent_link;

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        $this->metadatas = FileMetadata::get();
    }
    public function render()
    {
        return view('livewire.file-metadata.index');
    }
}
