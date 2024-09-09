<?php

namespace App\Livewire\Account;

use App\Models\User;
use App\Models\UserGroup as ModelsUserGroup;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class UserGroup extends Component
{
    use LivewireAlert;

    public $groups, $tags;
    public $name, $emails, $position;
    public $e_id, $e_name;
    public $e_user_group_emails, $users_not_in_groups;

    public $curent_link;

    protected $messages = [
        'name.required' => 'User group name wajib diisi',
        'name.unique' => 'User group sudah terdaftar..',
    ];

    public function mount()
    {
        $this->curent_link = Request::url();

        $this->groups = ModelsUserGroup::get();
    }

    public function store_user_group()
    {
        try {
            $this->validate([
                'name' => 'required|min:1|unique:user_groups,name',
            ]);

            DB::beginTransaction();

            $user = new ModelsUserGroup();
            $user->name = $this->name;
            $user->save();

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

    public function edit_user_group($id)
    {
        $group = ModelsUserGroup::find($id);
        $this->e_id = $group->id;
        $this->e_name = $group->name;
    }

    public function store_edit()
    {
        try {
            $this->validate([
                'e_name' => 'required|min:1|unique:user_groups,name',
            ]);

            DB::beginTransaction();

            $user = ModelsUserGroup::findOrFail($this->e_id);
            $user->name = $this->e_name;
            $user->save();

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

    public function add_email_to_user_group($id)
    {
        $group = ModelsUserGroup::find($id);
        $this->e_user_group_emails = $group->emails;
        $this->e_id = $group->id;

        $this->users_not_in_groups = User::get();
    }

    public function store_emails()
    {
        try {
            $this->validate([
                'e_user_group_emails' => 'required|min:5',
            ]);

            DB::beginTransaction();

            $user = ModelsUserGroup::findOrFail($this->e_id);
            $user->emails = $this->e_user_group_emails;
            $user->save();

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

    public function render()
    {
        return view('livewire.account.user-group');
    }
}
