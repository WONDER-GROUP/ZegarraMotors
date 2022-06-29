<?php

namespace App\Http\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Users extends Component
{
    protected $listeners = ['delete', 'updateSearch', 'clear'];
    public $users, $username, $name, $password, $f_last_name, $m_last_name, $nit, $cellphone, $address, $role;
    public $modal = 0;
    public $user_id;

    public function render()
    {
        $this->users = User::all();
        return view('livewire.users');
    }

    /* public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'username' => 'min:4|max:20|unique:users,username',
            'name' => 'min:3|max:20',
            'f_last_name' => 'min:3|max:15',
            'm_last_name' => 'min:3|max:15',
            'nit' => 'digits_between:6,12',
            'cellphone' => 'digits:8',
            'address' => 'min:5|max:40',
        ]);
    } */


    public function create()
    {
        $this->clear();
        $this->openModal();
    }

    public function openModal()
    {
        $this->modal = 1;
    }
    public function openModalUpdate()
    {
        $this->modal = 2;
    }

    public function closeModal()
    {
        $this->modal = 0;
        $this->clear();
    }

    public function clear()
    {
        $this->username = '';
        $this->name = '';
        $this->f_last_name = '';
        $this->m_last_name = '';
        $this->nit = '';
        $this->cellphone = '';
        $this->address = '';
        $this->resetErrorBag();
        $this->reset('role');
    }

    public function store()
    {
        $this->validate([
            'username' => 'required|min:4|max:20|unique:users,username',
            'name' => 'required|min:3|max:20',
            'f_last_name' => 'required|min:3|max:15',
            'm_last_name' => 'required|min:3|max:15',
            'nit' => 'required|digits_between:6,12|unique:people,nit',
            'cellphone' => 'required|digits:8',
            'address' => 'required|min:5|max:40',
            'role' => 'required',
        ]);
        $user = User::create([
            'username' => $this->username,
            'password' => Hash::make($this->nit),
        ])->assignRole($this->role);

        $user->people()->create([
            'name' => $this->name,
            'f_last_name' => $this->f_last_name,
            'm_last_name' => $this->m_last_name,
            'nit' => $this->nit,
            'cellphone' => $this->cellphone,
            'address' => $this->address,
        ]);

        $this->closeModal();
        $this->emit('save');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $this->username = $user->username;
        $this->name = $user->people->name;
        $this->f_last_name = $user->people->f_last_name;
        $this->m_last_name = $user->people->m_last_name;
        $this->nit = $user->people->nit;
        $this->cellphone = $user->people->cellphone;
        $this->address = $user->people->address;
        $this->user_id = $id;
        $this->role = $user->getRoleNames()->first();
        $this->openModalUpdate();
    }

    public function update()
    {
        $user = User::findOrFail($this->user_id);

        if ($user->people->nit == $this->nit) {
            $this->validate([
                'password' => 'max:30',
                'name' => 'required|min:3|max:20',
                'f_last_name' => 'required|min:3|max:15',
                'm_last_name' => 'required|min:3|max:15',
                'nit' => 'required|digits_between:6,12|exists:people,nit',
                'cellphone' => 'required|digits:8',
                'address' => 'required|min:5|max:40',
                'role' => 'required',
            ]);
            $user->update([
                'username' => $this->username,
            ]);
            if (isset($this->password)) {
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

        } else {
            $this->validate([
                'password' => 'max:30',
                'name' => 'required|min:3|max:20',
                'f_last_name' => 'required|min:3|max:15',
                'm_last_name' => 'required|min:3|max:15',
                'nit' => 'required|digits_between:6,12|unique:people,nit',
                'cellphone' => 'required|digits:8',
                'address' => 'required|min:5|max:40',
                'role' => 'required',
            ]);
            $user->update([
                'username' => $this->username,
            ]);
            if (isset($this->password)) {
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
        }

        // check if role user has changed
        if ($user->getRoleNames()->first() !== $this->role) {
            $user->removeRole($user->getRoleNames()->first());
            $user->assignRole($this->role);
        }

        $this->closeModal();
        $this->emit('save');
        // session()->flash('message', 'Usuario Actualizado Correctamente');

    }

    /**
     * register and deregister an user
     *  
     * @param User $user
     */
    public function registerUsers(User $user)
    {
        if (isset($user->email_verified_at)) {
            $user->email_verified_at = null;
        } else {
            $user->email_verified_at = now();
        }
        $user->save();
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Usuario Eliminado Correctamente');
    }
}
