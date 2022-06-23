<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Users extends Component
{
    public $users, $username, $name, $f_last_name, $m_last_name, $nit, $cellphone, $address;
    public $modal = 0;
    public $user_id;
    public function render()
    {
        $this->users = User::all();
        return view('livewire.users');
    }

    public function create(){
        $this->clear();
        $this->openModal();
    }

    public function openModal(){
        $this->modal = 1;
    }
    public function openModalUpdate(){
        $this->modal = 2;
    }

    public function closeModal(){
        $this->modal = 0;
    }

    public function clear(){
        $this->username = '';
        $this->name = '';
        $this->f_last_name = '';
        $this->m_last_name = '';
        $this->nit = '';
        $this->cellphone = '';
        $this->address = '';
    }

    public function store(){
        $user = User::create([
            'username' => $this->username,
            'password' => Hash::make($this->nit),
        ]);
        $user->people()->create([
            'name' => $this->name,
            'f_last_name' => $this->f_last_name,
            'm_last_name' => $this->m_last_name,
            'nit' => $this->nit,
            'cellphone' => $this->cellphone,
            'address' => $this->address,
        ]);
        $this->closeModal();
    }

    public function edit($id){
        $user = User::findOrFail($id);
        $this->username = $user->username;
        $this->name = $user->people->name;
        $this->f_last_name = $user->people->f_last_name;
        $this->m_last_name = $user->people->m_last_name;
        $this->nit = $user->people->nit;
        $this->cellphone = $user->people->cellphone;
        $this->address = $user->people->address;
        $this->user_id = $id; 
        $this->openModalUpdate();

    }

    public function update(){
        $user = User::findOrFail($this->user_id);
        $user->update([
            'username' => $this->username,
        ]);
        if(isset($this->password)){
            $user->update([
                'password' => Hash::make($this->password),
            ]);
        }
        $user->people->update([
            'name' => $this->name,
            'f_last_name' => $this->f_last_name,
            'm_last_name' => $this->m_last_name,
            'nit' => $this->nit,
            'cellphone' => $this->cellphone,
            'address' => $this->address,
        ]);
        $this->closeModal();
    }

    public function delete($id){
        User::find($id)->delete();
    }
}



