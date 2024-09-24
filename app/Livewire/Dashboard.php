<?php

namespace App\Livewire;

use App\Models\Activity;
use App\Models\File;
use App\Models\Folder;
use Carbon\Carbon;
use Livewire\Component;

class Dashboard extends Component
{
    public $duplicate, $workflow, $retention, $due_date, $all_files;

    public function mount()
    {
        $this->duplicate = Activity::where('activity', 'like', '%Duplicated from file%')->count();
        $this->workflow = File::where('approval_status', 'Waiting Approval')->count() + Folder::where('approval_status', 'Waiting Approval')->count();

        $expirationDate = Carbon::today()
            ->addDays(30);

        $this->retention = File::whereNotNull('active_until')
            ->where('active_until', '<', $expirationDate)
            ->get()->count();
        $this->due_date = File::whereNotNull('due_date')
            ->where('due_date', '<', $expirationDate)
            ->count();

        $this->all_files = File::count();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
