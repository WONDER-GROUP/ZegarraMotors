<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;

class Customers extends Component
{    
    use WithPagination;

    public $customerId;

    public $customer = [
        'name' => null,
        'f_last_name' => null,
        'm_last_name' => null,
        'cellphone' => null,
        'address' => null,
        'nit' => null,
        'edit' => false,
    ];

    protected $listeners = ['resetVariables', 'saveCustomer'];

    public function editCustomer(Customer $customer)
    {
        $this->customer = [
            'name' => $customer->name,
            'f_last_name' => $customer->f_last_name,
            'm_last_name' => $customer->m_last_name,
            'cellphone' => $customer->cellphone,
            'address' => $customer->address,
            'nit' => $customer->nit,
            'key' => $customer->id,
            'edit' => true,
        ];

        $this->customerId = $customer->id;
    }

    public function updateCustomer(Customer $customer)
    {
        if ($customer->nit == $this->customer['nit']) {
            $this->validate([
                'customer.name' => 'required|min:3|max:15',
                'customer.f_last_name' => 'required|min:3|max:20',
                'customer.m_last_name' => 'required|min:3|max:20',
                'customer.cellphone' => 'required|numeric',
                'customer.address' => 'required|min:6|max:30',
                'customer.nit' => 'required|numeric|exists:customers,nit'
            ]);

            $customer->name = $this->customer['name'];
            $customer->f_last_name = $this->customer['f_last_name'];
            $customer->m_last_name = $this->customer['m_last_name'];
            $customer->cellphone = $this->customer['cellphone'];
            $customer->address = $this->customer['address'];
            $customer->nit = $this->customer['nit'];
            $customer->save();
        } else {
            $this->validate([
                'customer.name' => 'required|min:3|max:15',
                'customer.f_last_name' => 'required|min:3|max:20',
                'customer.m_last_name' => 'required|min:3|max:20',
                'customer.cellphone' => 'required|numeric',
                'customer.address' => 'required|min:6|max:30',
                'customer.nit' => 'required|numeric|unique:customers,nit'
            ]);

            $customer->name = $this->customer['name'];
            $customer->f_last_name = $this->customer['f_last_name'];
            $customer->m_last_name = $this->customer['m_last_name'];
            $customer->cellphone = $this->customer['cellphone'];
            $customer->address = $this->customer['address'];
            $customer->nit = $this->customer['nit'];
            $customer->save();
        }

        $this->emit('success');
        $this->resetVariables();
    }

    public function deleteCustomer(Customer $customer)
    {
        $customer->delete();
        $this->emit('success');
    }

    public function resetVariables()
    {
        $this->reset('customer');
        $this->resetValidation();
    }

    public function saveCustomer()
    {
        $this->render();
        $this->emit('success');
    }

    public function render()
    {
        $customers = Customer::orderBy('created_at', 'DESC')->paginate(10);

        return view('livewire.admin.customers', compact('customers'));
    }
}
