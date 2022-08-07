<?php

namespace App\Http\Livewire\Admin;

use App\Models\Product;
use Livewire\Component;
use App\Models\Presentation;
use Livewire\WithPagination;

class Products extends Component
{
    use WithPagination;

    public $product = [
        'name' => null,
        'stock' => null,
        'branch' => null,
        'description' => null,
        'price' => null,
        'addProduct' => false,
        'addService' => false,
        'editProduct' => false,
        'editService' => false,
    ];

    public $productId;

    // Variables for presentations
    public $name, $presentationId, $presentations;

    public $presentation;

    protected $rules = [
        'presentations.*.id' => '',
        'presentations.*.name' => '',

        'presentation.id' => '',
        'presentation.name' => '',
    ];

    protected $listeners = ['saveInventory'];

    public function mount()
    {
        $this->getPresentations();
    }

    public function saveProduct()
    {
        $rules = [
            'product.name' => 'required|max:25',
            'product.description' => 'required',
        ];

        if (Product::isService($this->name)) {
            $rules['product.price'] = 'required';
            $this->validate($rules);
        } else {
            $rules['product.branch'] = 'required';
            $this->validate($rules);
        }

        $presentation = Presentation::find($this->presentationId);

        if ($presentation) {
            $product = new Product();
            $product->user_id = auth()->user()->id;
            $product->presentation_id = $presentation->id;
            $product->name = $this->product['name'];
            $product->branch = $this->product['branch'];
            $product->description = $this->product['description'];
            $product->price = $this->product['price'];
            $product->save();
        } else {
            if ($this->name) {
                $presentation = new Presentation();
                $presentation->name = $this->name;
                $presentation->save();

                $product = new Product();
                $product->user_id = auth()->user()->id;
                $product->presentation_id = $presentation->id;
                $product->name = $this->product['name'];
                $product->branch = $this->product['branch'];
                $product->description = $this->product['description'];
                $product->price = $this->product['price'];
                $product->save();
            } else {
                $product = new Product();
                $product->user_id = auth()->user()->id;
                $product->presentation_id = 1;
                $product->name = $this->product['name'];
                $product->branch = $this->product['branch'];
                $product->description = $this->product['description'];
                $product->save();
            }
        }

        $this->emit('success');
        $this->resetVariables();
    }

    public function editProduct(Product $product)
    {
        $this->productId = $product->id;

        $this->product['name'] = $product->name;
        $this->product['branch'] = $product->branch;
        $this->product['description'] = $product->description;
        $this->product['editProduct'] = true;

        $this->name = $product->presentation->name;
        $this->presentationId = $product->presentation_id;
    }

    public function editService(Product $product)
    {
        $this->productId = $product->id;

        $this->product['name'] = $product->name;
        $this->product['description'] = $product->description;
        $this->product['editService'] = true;

        $this->name = $product->presentation->name;
        $this->presentationId = $product->presentation_id;
    }

    public function updateProduct(Product $product)
    {
        $this->validate([
            'product.name' => 'required|max:25',
            'product.branch' => 'required',
            'product.description' => 'required',
        ]);

        $presentation = Presentation::find($this->presentationId);

        if ($presentation) {
            $product->presentation_id = $presentation->id;
            $product->name = $this->product['name'];
            $product->branch = $this->product['branch'];
            $product->description = $this->product['description'];
            $product->save();
        } else {
            if ($this->name) {
                $presentation = new Presentation();
                $presentation->name = $this->name;
                $presentation->save();

                $product->presentation_id = $presentation->id;
                $product->name = $this->product['name'];
                $product->branch = $this->product['branch'];
                $product->description = $this->product['description'];
                $product->save();
            } else {
                $product->presentation_id = 1;
                $product->name = $this->product['name'];
                $product->branch = $this->product['branch'];
                $product->description = $this->product['description'];
                $product->save();
            }
        }

        $this->emit('success');
        $this->resetVariables();
    }

    public function updateService(Product $product)
    {
        $this->validate([
            'product.name' => 'required|max:25',
            'product.description' => 'required',
            'product.price' => 'required',
        ]);

        $product->presentation_id = $this->presentationId;
        $product->name = $this->product['name'];
        $product->branch = $this->product['branch'];
        $product->description = $this->product['description'];
        $product->price = $this->product['price'];
        $product->save();

        $this->emit('success');
        $this->resetVariables();
    }

    public function deleteProduct(Product $product)
    {
        $product->delete();
    }

    public function presentationId()
    {
        $this->presentation = Product::find($this->presentationId);
    }

    public function updatedName()
    {
        $this->getPresentations();
    }

    public function getPresentations()
    {
        $this->presentations = Presentation::query()
            ->when($this->name, function ($query, $name) {
                return $query->where('name', 'LIKE', '%' . $name . '%');
            })
            ->orderBy('name')
            ->get();
    }

    public function resetVariables()
    {
        $this->reset('product', 'productId', 'name', );
        $this->resetValidation();
    }

    public function saveInventory()
    {
        $this->render();
        $this->emit('success');
    }

    public function showInventories($productId)
    {
        redirect(route('admin.showInventories', $productId));
    }

    public function render()
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.products', compact('products'));
    }
}
