<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class AuthorChangePasswordForm extends Component
{
    public $current_password, $new_password, $confirm_new_password;

    public function changePassword()
    {
        $this->validate([
            'current_password' => [
                'required', function($attribute, $value, $fail) {
                    if(!Hash::check($value, User::find(auth('web')->id())->password)) {
                        return $fail(__('The current password is incorrent'));
                    }
                }
            ],
            'new_password' => 'required|min:6|max:25',
            'confirm_new_password' => 'same:new_password'
        ]);

        $query = User::find(auth('web')->id())->update([
            'password' => bcrypt($this->new_password),
        ]);

        if($query) {
            $this->dispatchBrowserEvent('success', ['message' => 'Password updated successfully.']);
            $this->current_password = $this->new_password = $this->confirm_new_password = null;
        }
    }

    public function render()
    {
        return view('livewire.author-change-password-form');
    }
}
