<?php

namespace App\Livewire\Account;

use App\Models\GlobalSetting;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class PasswordPolicyIndex extends Component
{
    use LivewireAlert;

    public $settings = [];
    public $curent_link;
    public function mount()
    {
        $this->curent_link = Request::url();

        $settings = GlobalSetting::all();

        foreach ($settings as $setting) {
            $this->settings[$setting->name] = ($setting->name == 'enable_password_policy' || $setting->name == 'require_2fa') ? ($setting->value == 1 ? true : $setting->value) : $setting->value;
            // $this->enable_password_policy = $setting->name == 'enable_password_policy' ? $setting->value : null;
            // $this->require_2fa = $setting->name == 'require_2fa' ? $setting->value : null;
            // $this->minimum_length = $setting->name == 'minimum_length' ? $setting->value : null;
            // $this->lowercase = $setting->name == 'lowercase' ? $setting->value : null;
            // $this->uppercase = $setting->name == 'uppercase' ? $setting->value : null;
            // $this->numbers = $setting->name == 'numbers' ? $setting->value : null;
            // $this->special_characters = $setting->name == 'special_characters' ? $setting->value : null;
            // $this->rotation = $setting->name == 'rotation' ? $setting->value : null;
            // $this->reuse_limit = $setting->name == 'reuse_limit' ? $setting->value : null;
        }
        // dd($this->reuse_limit);

        // $this->enable_password_policy = $this->settings;
        // $this->require_2fa = $this->settings;
        // $this->minimum_length = $this->settings;
        // $this->lowercase = $this->settings;
        // $this->uppercase = $this->settings;
        // $this->numbers = $this->settings;
        // $this->special_characters = $this->settings;
        // $this->rotation = $this->settings;
        // $this->reuse_limit = $this->settings;
    }

    public function store()
    {
        try {
            // $this->validate([
            //     'name' => 'required|min:3',
            //     'email' => 'required|email|unique:users,email',
            //     'position' => '',
            // ]);

            DB::beginTransaction();
            foreach ($this->settings as $name => $value) {
                $oldSetting = GlobalSetting::where('name', $name);
                if ($oldSetting->count()) {
                    $newSetting = $oldSetting->first();
                } else {
                    $newSetting = new GlobalSetting();
                }

                $newSetting->name = $name;
                $newSetting->value = $value;
                $newSetting->save();
                // dd($newSetting);
            }
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
        return view('livewire.account.password-policy-index');
    }
}
