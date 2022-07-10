<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Customer;

class AddCustomers extends Component
{
    public $addCustomer = false;

    public $customer = [
        'name' => null,
        'f_last_name' => null,
        'm_last_name' => null,
        'cellphone' => null,
        'address' => null,
        'nit' => null,
    ];

    protected $listeners = ['openModal'];

    public function openModal()
    {
        $this->addCustomer = !$this->addCustomer;
    }

    public function save()
    {
        $this->validate([
            'customer.name' => 'required|min:3|max:30',
            'customer.f_last_name' => 'required|min:3|max:20',
            'customer.m_last_name' => 'required|min:3|max:20',
            'customer.cellphone' => 'required|numeric',
            'customer.address' => 'required|min:6|max:30',
            'customer.nit' => 'required|numeric|unique:customers,nit'
        ]);

        $customer = new Customer();
        $customer->name = $this->customer['name'];
        $customer->f_last_name = $this->customer['f_last_name'];
        $customer->m_last_name = $this->customer['m_last_name'];
        $customer->cellphone = $this->customer['cellphone'];
        $customer->address = $this->customer['address'];
        $customer->nit = $this->customer['nit'];
        $customer->save();

        $this->resetVariables();
        $this->emitTo('admin.customers', 'saveCustomer');
    }

    public function resetVariables()
    {
        $this->reset('customer', 'addCustomer');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.add-customers');
    }
}
