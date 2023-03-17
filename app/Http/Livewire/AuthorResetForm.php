<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthorResetForm extends Component
{
    public $email, $token, $new_password, $confirm_new_password;

    public function mount()
    {
        $this->email = request()->email;
        $this->token = request()->token;
    }

    public function ResetHandler()
    {
        $this->validate([
            'email' => 'required|email|exists:users,email',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'same:new_password'
        ]);

        $check_token = DB::table('password_resets')->where([
            'email' => $this->email,
            'token' => $this->token
        ])->first();

        if(!$check_token) {
            session()->flash('fail', 'Invalid Token.');
        } else {
            User::where('email', $this->email)->update([
                'password' => Hash::make($this->new_password)
            ]);

            DB::table('password_resets')->where([
                'email' => $this->email
            ])->delete();

           $success_token = Str::random(64);
           session()->flash('success', 'Your password has been updated successfully. Login with your email and your new password');
           
           $this->redirectRoute('author.login',['tkn' => $success_token, 'UEmail' => $this->email]);
        }
    }

    public function render()
    {
        return view('livewire.author-reset-form');
    }
}
