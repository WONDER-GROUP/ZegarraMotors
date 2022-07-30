<?php

namespace App\Http\Livewire\Admin;

use App\Models\Car;
use App\Models\Mileage;
use Livewire\Component;

class AddMileage extends Component
{
    public $car;
    public $mileage = [
        'input_kilometer' => null,
        'output_kilometer' => null,
        'input_date' => null,
        'output_date' => null,
        'addMileage' => false,
    ];

    protected $listeners = ['openModalMileage'];

    public function openModalMileage(Car $car)
    {
        $this->mileage['addMileage'] = true;
        $this->car = $car;
    }

    public function saveMileage(){
        $this->validate([
            'mileage.input_kilometer' => 'required|numeric|min:1',
            'mileage.output_kilometer' => 'required|numeric|min:1',
            'mileage.input_date' => 'required|date',
            'mileage.output_date' => 'required|date',
        ]);

        $mileage = new Mileage();
        $mileage->car_id = $this->car->id;
        $mileage->input_kilometer = $this->mileage['input_kilometer'];
        $mileage->output_kilometer = $this->mileage['output_kilometer'];
        $mileage->input_date = $this->mileage['input_date'];
        $mileage->output_date = $this->mileage['output_date'];
        $mileage->save();

        $this->emitTo('admin.cars', 'saveMileage');
        $this->resetVariables();
    }

    public function resetVariables()
    {
        $this->reset('car', 'mileage');
        $this->resetValidation();
    }


    public function render()
    {
        return view('livewire.admin.add-mileage');
    }
}
