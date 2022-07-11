<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Inventory;
use Livewire\WithPagination;

class Inventories extends Component
{
    use WithPagination;

    public $inventory = [
        'stock' => null,
        'lot' => null,
        'purchase_price' => null,
        'sale_price' => null,
        'exp_date' => null,
        'addInventory' => false
    ];

    public $inventoryId, $productId;

    public function mount($productId = null)
    {
        $this->productId = $productId;
    }

    public function editInventory(Inventory $inventory)
    {
        $this->inventory['stock'] = $inventory->stock;
        $this->inventory['lot'] = $inventory->lot;
        $this->inventory['purchase_price'] = $inventory->purchase_price;
        $this->inventory['sale_price'] = $inventory->sale_price;
        $this->inventory['exp_date'] = $inventory->exp_date;
        $this->inventory['addInventory'] = true;

        $this->inventoryId = $inventory->id;
    }

    public function updateInventory(Inventory $inventory)
    {
        $rules = [
            'inventory.stock' => 'required|numeric',
            'inventory.purchase_price' => 'required|numeric|min:1',
            'inventory.sale_price' => 'required|numeric|min:1',
            'inventory.exp_date' => 'nullable|date',
        ];

        if ($inventory->lot == $this->inventory['lot']) {
            $rules ['inventory.lot'] = 'required|numeric|min:0|exists:inventories,lot';
        } else {
            $rules ['inventory.lot'] = 'required|numeric|min:0|unique:inventories,lot';
        }

        $this->validate($rules);

        $inventory->product->stock -= $inventory->stock;
        $inventory->product->save();

        $inventory->stock = $this->inventory['stock'];
        $inventory->lot = $this->inventory['lot'];
        $inventory->purchase_price = $this->inventory['purchase_price'];
        $inventory->sale_price = $this->inventory['sale_price'];
        $inventory->exp_date = $this->inventory['exp_date'];
        $inventory->save();

        $inventory->product->stock += $inventory->stock;
        $inventory->product->save();

        $this->emit('success');
        $this->resetVariables();
    }

    public function resetVariables()
    {
        $this->reset('inventoryId', 'inventory');
        $this->resetValidation();
    }

    public function render()
    {
        if ($this->productId) {
            $inventories = Inventory::where('product_id', $this->productId)->orderBy('created_at', 'desc')->paginate(10);
        } else {
            $inventories = Inventory::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('livewire.admin.inventories', compact('inventories'));
    }
}
