<?php

namespace App\Livewire\Account;

use App\Mail\AfterCreatedUser;
use App\Models\Tag;
use App\Models\User as ModelsUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Illuminate\Support\Str;


class User extends Component
{
    use LivewireAlert;

    public $users, $tags;
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

        $this->users = ModelsUser::get();
        $this->tags = Tag::pluck('name', 'id');
    }

    public function add_user()
    {
        try {
            $this->validate([
                'name' => 'required|min:3',
                'email' => 'required|email|unique:users,email',
                'position' => '',
            ]);

            DB::beginTransaction();

            $user = new ModelsUser();
            $user->email = $this->email;
            $user->name = $this->name;
            $user->position = $this->position;
            $user->password = bcrypt(123123123);
            $user->save();

            $text = "Created new team user : $user->email";
            $user->newActivity($user->id, $text);
            // dd($user->id);

            DB::commit();

            $data = [
                'subject' => 'Document System has invited you to join',
                'title' => 'Welcome to Document Systems',
                'body' => 'Body',
                'user_id' => $user->id,
                'position' => $user->position,
                'email' => $user->email,
                'user_name' => $user->name,
            ];
            Mail::to($this->email)->send(new AfterCreatedUser($data));

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

    public function edit_user($id)
    {
        $user = ModelsUser::find($id);
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

            $user = ModelsUser::findOrFail($this->e_id);
            // $user->email = $this->e_email;
            $user->name = $this->e_name;
            $user->position = $this->e_position;
            // $user->password = bcrypt(123123123);
            $user->save();

            $text = "Modified team user : $user->email";
            $user->newActivity($this->e_id, $text);
            // dd($user);

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

    public function destroy($id) {}

    public function render()
    {
        return view('livewire.account.user');
    }
}
