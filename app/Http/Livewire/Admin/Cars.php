<?php

namespace App\Http\Livewire\Admin;

use App\Models\Car;
use App\Models\Customer;
use Livewire\Component;
use Livewire\WithPagination;

class Cars extends Component
{
    use WithPagination;

    public $car = [
        'customer_id' => 0, 
        'brand' => null,
        'model' => null,
        'color' => null,
        'number_plate' => null,
        'addCar' => false,
        'editCar' => false,
    ];

    public $carId;

    
    protected $listeners = ['resetVariables', 'saveCustomer'];




    public function resetVariables()
    {
        $this->reset('car', 'carId');
        $this->resetValidation();
    }

    

    public function saveCar()
    {
        $this->validate([
            'car.customer_id' => 'required',
            'car.brand' => 'required|max:25',
            'car.model' => 'required',
            'car.color' => 'required',
            'car.number_plate' => 'required',
        ]);
        
        $car = new Car();
        $car->user_id = auth()->user()->id;
        $car->customer_id = $this->car['customer_id'];
        $car->brand = $this->car['brand'];
        $car->model = $this->car['model'];
        $car->color = $this->car['color'];
        $car->number_plate = $this->car['number_plate'];
        $car->save();
        $this->emit('success');
        $this->resetVariables();
    }

    public function editCar(Car $car)
    {
        $this->carId = $car->id;

        $this->car['brand'] = $car->brand;
        $this->car['model'] = $car->model;
        $this->car['color'] = $car->color;
        $this->car['number_plate'] = $car->number_plate;
        $this->car['editCar'] = true;
    }

    public function updateCar(Car $car){
        $this->validate([
            'car.brand' => 'required|max:25',
            'car.model' => 'required',
            'car.color' => 'required',
            'car.number_plate' => 'required',
        ]);

        $car->brand = $this->car['brand'];
        $car->model = $this->car['model'];
        $car->color = $this->car['color'];
        $car->number_plate = $this->car['number_plate'];
        $car->save();

        $this->emit('success');
        $this->resetVariables();
    }

    public function deleteCar(Car $car)
    {
        $car->delete();
    }
    
    public function saveMileage()
    {
        $this->render();
        $this->emit('success');
    }

    public function showMileages($carId)
    {
        redirect(route('admin.showMileages', $carId));
    }

    public function render()
    {
        $customers = Customer::all();
        $cars = Car::orderBy('created_at', 'desc')->paginate(10);
        return view('livewire.admin.cars', compact('customers', 'cars'));
    }
}