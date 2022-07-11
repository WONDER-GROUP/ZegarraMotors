<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Inventory;

class AddInventory extends Component
{
    public $product;

    public $inventory = [
        'stock' => null,
        'lot' => null,
        'purchase_price' => null,
        'sale_price' => null,
        'exp_date' => null,
        'addInventory' => false
    ];

    protected $listeners = ['openModalInventory'];

    public function openModalInventory(Product $product)
    {
        $this->inventory['addInventory'] = true;
        $this->product = $product;
    }

    public function saveInventory()
    {
        $this->validate([
            'inventory.stock' => 'required|numeric|min:1',
            'inventory.lot' => 'required|numeric|min:0|unique:inventories,lot',
            'inventory.purchase_price' => 'required|numeric|min:1',
            'inventory.sale_price' => 'required|numeric|min:1',
            'inventory.exp_date' => 'nullable|date',
        ]);

        $inventory = new Inventory();
        $inventory->product_id = $this->product->id;
        $inventory->stock = $this->inventory['stock'];
        $inventory->lot = $this->inventory['lot'];
        $inventory->purchase_price = $this->inventory['purchase_price'];
        $inventory->sale_price = $this->inventory['sale_price'];
        $inventory->exp_date = $this->inventory['exp_date'];
        $inventory->save();
        
        $this->product->stock += $inventory->stock;
        $this->product->save();

        $this->emitTo('admin.products', 'saveInventory');
        $this->resetVariables();
    }

    public function resetVariables()
    {
        $this->reset('product', 'inventory');
        $this->resetValidation();
    }

    public function render()
    {
        return view('livewire.admin.add-inventory');
    }
}
