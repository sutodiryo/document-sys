<?php

namespace App\Livewire\File;

use App\Models\File;
use Livewire\Component;

class Approval extends Component
{
    public $id;
    public $data;

    public function mount()
    {
        $file = File::findOrFail($this->id);

        $this->data = [
            'title' => 'Document Systems',
            'id' => $file->id,
            'name' => $file->name,
            'resolution' => $file->approval_resolution,
            'users' => $file->approval,
            'folder' => $file,
            'created' => $file->created_at,
            'last_updated' => $file->updated_at,
        ];

        // dd($data);

        // return view('resolution.folder_resolution', compact('data'));
    }

    public function render()
    {
        return view('livewire.file.approval');
    }
}
