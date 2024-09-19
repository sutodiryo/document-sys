<?php

namespace App\Livewire\File;

use App\Models\File;
use App\Models\Metadata;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads, LivewireAlert;
    #[Url]

    public $uuid;
    public $tags = [];
    public $file, $name, $verified_by, $date, $due_date, $description;

    public $metadata_name, $metadata_description, $metadata_data_type, $metadata_allow_multiple_use, $selected_metadata_id, $selected_metadata_name, $selected_metadata_value;
    public $curent_link;

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        $this->file = File::find($this->uuid);
        $this->name = $this->file->name;
        $this->verified_by = $this->file->verified_by;
    }

    public function store_metadata()
    {
        // $data = [
        // 'file_id' => $this->uuid,
        // 'name' => $this->metadata_name,
        // 'description' => $this->metadata_description,
        // 'data_type' => $this->metadata_data_type,
        // 'allow_multiple_use' => $this->metadata_allow_multiple_use,
        // ];
        DB::beginTransaction();
        $store = $this->file->metadatas()->create([
            'file_id' => $this->uuid,
            'name' => $this->metadata_name,
            'description' => $this->metadata_description,
            'data_type' => $this->metadata_data_type,
            'allow_multiple_use' => $this->metadata_allow_multiple_use,
        ]);
        // $store = Metadata::create($data);
        // dd($store);
        DB::commit();
        return redirect($this->curent_link);
    }


    public function setSelectedMetadata($id, $name)
    {
        $this->selected_metadata_id = $id;
        $this->selected_metadata_name = $name;
    }

    public function store_metadata_value()
    {
        DB::beginTransaction();
        $metadata = Metadata::find($this->selected_metadata_id);
        $metadata->update(['value' => $this->selected_metadata_value]);
        // dd($metadata);
        DB::commit();

        return redirect($this->curent_link);
    }

    public function render()
    {
        return view('livewire.file.edit');
    }
}
