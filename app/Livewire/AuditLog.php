<?php

namespace App\Livewire;

use App\Models\Activity;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AuditLog extends Component
{
    use LivewireAlert;

    public $logs;
    public $curent_link;

    public function mount()
    {
        $this->curent_link = Request::url() . '?uuid=' . request()->uuid;

        $this->logs = Activity::orderBy('created_at','DESC')->get();
    }

    public function render()
    {
        return view('livewire.audit-log');
    }
}
