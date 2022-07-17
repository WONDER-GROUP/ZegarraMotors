<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use App\Models\Invoice;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;

class SalesCreate extends Component
{
    // variables for add products
    public $customerId, $productId, $inventories, $inventoryId = "", $quantity;

    // variables for list products added
    public $listProducts = [], $listLots = [], $listQuantity = [], $listSubtotal = [];
    public $total = 0, $discount = 0, $payment, $change, $buttonsPayment = false;

    protected $listeners = ['resetVariables', 'saveCustomer'];

    public function mount()
    {
        $this->savedProducts = Product::whereIn('id', $this->listProducts)->get();
    }

    public function addProduct()
    {
        $this->validate([
            'productId' => 'required',
            'inventoryId' => 'required',
            'quantity' => 'required'
        ]);

        if (in_array($this->inventoryId, $this->listLots)) {
            $this->emit('inventoryExist');
        } else {
            array_push($this->listProducts, $this->productId);
            array_push($this->listLots, $this->inventoryId);
            array_push($this->listQuantity, $this->quantity);

            $this->computeTotal();

            $this->emit('success');
            $this->reset('productId', 'inventoryId', 'quantity', 'inventories');
            $this->emit('clearProduct');
        }
    }

    public function computeTotal()
    {
        $this->reset('listSubtotal', 'total');

        foreach ($this->listProducts as $key => $id) {
            $product = Product::find($id);
            $lot = $product->inventories->find($this->listLots[$key]);
            array_push($this->listSubtotal, round($lot->sale_price * $this->listQuantity[$key], 2));
            $this->total += $this->listSubtotal[$key];
        }
    }

    public function deleteProduct($key)
    {
        unset($this->listProducts[$key]);
        $this->listProducts = array_values($this->listProducts);

        unset($this->listSubtotal[$key]);
        $this->listSubtotal = array_values($this->listSubtotal);

        unset($this->listLots[$key]);
        $this->listLots = array_values($this->listLots);

        $this->computeTotal();
    }

    public function updatedPayment()
    {
        $this->validate([
            'payment' => 'required|numeric|integer|min:1',
        ]);

        // verify a correct amount of payment
        if ($this->payment >= ($this->total - $this->discount)) {
            $this->buttonsPayment = true;
            $this->change = round($this->payment - ($this->total - $this->discount), 2);
        } else {
            $this->buttonsPayment = false;
        }
    }

    public function saveOrder()
    {
        $this->validate([
            'customerId' => 'required',
            'discount' => 'required|numeric|integer|min:0',
            'payment' => 'required|numeric|integer|min:1',
        ]);

        // Extract data for save on invoices
        $customer = Customer::find($this->customerId);

        $order = new Order;
        $order->user_id = auth()->user()->id;
        $order->customer_id = $this->customerId;
        $order->payment = $this->payment;
        $order->discount = $this->discount;
        $order->total = $this->total;
        $order->ciSearch = $customer->nit;
        $order->save();

        // Updating data of stock
        foreach ($this->listProducts as $key => $id) {
            $product = Product::find($id);
            $lot = $product->inventories->find($this->listLots[$key]);

            // Insert data of order on table pivot
            DB::table('order_product')->insert([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $this->listQuantity[$key],
                'price' => $lot->sale_price,
            ]);

            // computing the new stock
            $lot->stock -= $this->listQuantity[$key];
            $lot->save();

            $stock = 0;
            foreach ($product->inventories as $key => $lot) {
                $stock += $lot->stock;
            }

            $product->stock = $stock;
            $product->save();
        }



        // Save invoice type ORDER
        $invoice = new Invoice();
        $invoice->nit = $customer->nit;
        $invoice->customer_full_name = $customer->name . ' ' . $customer->f_last_name . ' ' . $customer->m_last_name;
        $invoice->user_full_name = auth()->user()->people->name . ' ' . auth()->user()->people->f_last_name . ' ' . auth()->user()->people->m_last_name;
        $invoice->data = json_encode($order);
        $invoice->type = Invoice::ORDER;
        $invoice->save();

        return redirect(route('admin.sales'));
    }

    public function updatedQuantity()
    {
        $this->validate([
            'quantity' => 'required|numeric|integer|min:1',
        ]);

        if ($this->quantity > Inventory::find($this->inventoryId)->stock || $this->quantity < 0) {
            $this->emit('errorStock');
            $this->reset('quantity');
        }
    }

    public function updatedProductId()
    {
        $this->inventoryId = "";
        $this->inventories = Product::find($this->productId)->inventories;

        $this->resetValidation('quantity');
        $this->reset('quantity');
    }

    public function updatedInventoryId()
    {
        $this->resetValidation('quantity');
        $this->reset('quantity');
    }

    public function saveCustomer(Customer $customer)
    {
        $this->render();
        $this->emit('addCustomer', $customer->id, $customer->name, $customer->f_last_name, $customer->m_last_name);
        $this->customerId = $customer->id;
        $this->emit('success');
    }

    public function render()
    {
        $customers = Customer::all();
        $products = Product::all();

        return view('livewire.admin.sales-create', compact('customers', 'products'));
    }
}
