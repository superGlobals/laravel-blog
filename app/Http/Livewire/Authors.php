<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Nette\Utils\Random;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Authors extends Component
{
    public $name, $email, $username, $author_type, $direct_publisher;

    protected $listeners = [
        'resetForms'
    ];

    public function resetForms()
    {
        $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
        $this->resetErrorBag();
    }

    public function addAuthor()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|unique:users,username|min:6|max:20',
            'author_type' => 'required',
            'direct_publisher' => 'required',
        ]);

        if($this->isOnline()) {
            $default_password = Random::generate(10);

            $author = new User();
            $author->name = $this->name;
            $author->email = $this->email;
            $author->username = $this->username;
            $author->password = Hash::make($default_password);
            $author->type = $this->author_type;
            $author->direct_publisher = $this->direct_publisher;
            $saved = $author->save();

            $data = [
                'name' => $this->name,
                'username' => $this->username,
                'email' => $this->email,
                'password' => $default_password,
                'url' => route('author.profile')
            ];

            $author_email = $this->email;
            $author_name = $this->name;

            if($saved) {
                Mail::send('new-author-email-template', $data, function($message) use ($author_email, $author_name) {
                    $message->from('noreply@example.com','LaraBlog');
                    $message->to($author_email, $author_name)
                            ->subject('Account creation');
                });
                $this->dispatchBrowserEvent('success', ['message' => 'New author has been added']);
                $this->name = $this->email = $this->username = $this->author_type = $this->direct_publisher = null;
                $this->dispatchBrowserEvent('hide_add_author_modal');

            } else {
                $this->dispatchBrowserEvent('error', ['message' => 'Something went wrong']);
            }

        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'You are offline, check your connection and submit your form again later.']);
        }
    }

    public function isOnline($site = "https://youtube.com")
    {
        if(@fopen($site,"r")) {
            return true;
        } else {
            return false;
        }
    }

    public function render()
    {
        return view('livewire.authors', [
            'authors' => User::where('id', '!=', auth()->id())->get()
        ]);
    }


    
}
