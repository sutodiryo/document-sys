<?php

namespace App\Livewire\Components;

use Livewire\Component;

class UploadFiles extends Component
{
    public $id, $error, $files;
    public function render()
    {
        return view('livewire.components.upload-files');
    }
}
