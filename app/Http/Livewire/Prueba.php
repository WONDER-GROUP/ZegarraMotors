<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class Prueba extends Component
{
    public $name;

    public function mount()
    {
    }

    public function save()
    {
        $user = new User();
        $user->name = $this->name;
        $user->save();
    }

    public function render()
    {
        return view('livewire.prueba');
    }
}
