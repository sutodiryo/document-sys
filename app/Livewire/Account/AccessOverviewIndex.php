<?php

namespace App\Livewire\Account;

use App\Models\FileShare;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class AccessOverviewIndex extends Component
{
    use LivewireAlert;

    public $users, $public_links;
    public $name, $email, $position;
    public $e_id, $e_name, $e_email, $e_position;

    public $curent_link;

    protected $messages = [
        'email.required' => 'Email wajib diisi',
        'email.unique' => 'Email sudah terdaftar..',
    ];

    protected $listeners = [
        // 'refreshComponent' => '$refresh',
        'searchUpdated' => 'searchUpdated',
    ];

    public function mount()
    {
        $this->curent_link = Request::url();
        $this->users = User::get();

        $this->public_links = FileShare::whereNotNull('by_link')->get();
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        $this->e_id = $user->id;
        $this->e_name = $user->name;
        $this->e_email = $user->email;
        $this->e_position = $user->position;
    }

    public function store_edit()
    {
        try {
            $this->validate([
                'e_name' => 'required|min:3',
                // 'email' => 'required|email|unique:users,email',
                'e_position' => '',
            ]);

            DB::beginTransaction();

            $user = User::findOrFail($this->e_id);
            $user->name = $this->e_name;
            $user->position = $this->e_position;
            $user->save();

            $text = "Modified team user : $user->email";
            $user->newActivity($this->e_id, $text);

            DB::commit();

            $this->flash('success', 'Data berhasil di simpan!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
        } catch (\Throwable $th) {

            $this->flash('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ], $this->curent_link);
        }
    }

    public function remove_all_access()
    {
        try {
            DB::beginTransaction();

            // $user = User::findOrFail($this->e_id);
            // $user->name = $this->e_name;
            // $user->save();

            DB::commit();

            $this->flash('success', 'Semua akses telah dihapus!', [
                'position' => 'top-end',
                'timer' => 3000,
                'toast' => true,
                'timerProgressBar' => true,
            ], $this->curent_link);
        } catch (\Throwable $th) {

            $this->flash('error', $th->getMessage(), [
                'position' => 'center',
                'timer' => 0,
                'toast' => false,
                'showCancelButton' => true,
                'cancelButtonText' => 'OK',
            ], $this->curent_link);
        }
    }


    public function render()
    {
        return view('livewire.account.access-overview-index');
    }
}
