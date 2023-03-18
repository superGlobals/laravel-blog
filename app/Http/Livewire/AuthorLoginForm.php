<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class AuthorLoginForm extends Component
{
    public $login_id, $password;
    public $returnUrl;

    public function mount()
    {
        $this->returnUrl = request()->returnUrl;
    }

    public function LoginHandler()
    {
        $fieldType = filter_var($this->login_id, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        if($fieldType == 'email') {
            $this->validate([
                'login_id' => 'required|email',
                'password' => 'required'
            ]);
        } else {
            $this->validate([
                'login_id' => 'required',
                'password' => 'required'
            ]);
        }

        $credentials = [
            $fieldType => $this->login_id,
            'password' => $this->password
        ];

        if(Auth::guard('web')->attempt($credentials)) {
            $checkUser = User::where($fieldType, $this->login_id)->first();

            if($checkUser->blocked == 1) {
                Auth::guard('web')->logout();
                return redirect()->route('author.login')->with('fail', 'Your account has been blocked');
            } else {
                // return redirect()->route('author.home');
                if($this->returnUrl != null) {
                    return redirect()->to($this->returnUrl);
                }
                return redirect()->route('author.home');
            }
                
        } else {
            session()->flash('fail', 'Invalid Credentials');
        }

        // $this->validate([
        //     'email' => 'required|email',
        //     'password' => 'required'
        // ]);

        // $credentials = [
        //     'email' => $this->email,
        //     'password' => $this->password,
        // ];

        // if(Auth::guard('web')->attempt($credentials)) {

        //     $checkUser = User::where('email', $this->email)->first();

        //     if($checkUser->blocked == 1) {
        //         Auth::guard('web')->logout();
        //         return redirect()->route('author.login')->with('fail', 'Your account had been blocked');
        //     } else {
        //         return redirect()->route('author.home');
        //     }
            
        // } else {
        //     session()->flash('fail', 'Invalid Credentials');
        // }
    }
    
    public function render()
    {
        return view('livewire.author-login-form');
    }
}
