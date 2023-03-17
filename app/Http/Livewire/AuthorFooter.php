<?php

namespace App\Http\Livewire;

use App\Models\Setting;
use Livewire\Component;

class AuthorFooter extends Component
{
    public $settings;

    protected $listeners = [
        'updateAuthorFooter' => '$refresh'
    ];

    public function mount()
    {
        $this->settings = Setting::find(1);
    }

    public function render()
    {
        return view('livewire.author-footer');
    }
}
