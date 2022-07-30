<?php

namespace App\Http\Livewire\Admin;

use App\Models\Mileage;
use Livewire\Component;
use Livewire\WithPagination;

class Mileages extends Component
{
    use WithPagination;

    public $mileage = [
        'input_kilometer' => null,
        'output_kilometer' => null,
        'input_date' => null,
        'output_date' => null,
        'addMileage' => false
    ];

    public $mileageId, $carId;

    public function mount($carId = null){
        $this->carId = $carId;
    }

    public function editMileage(Mileage $mileage){
        $this->mileage['input_kilometer'] = $mileage->input_kilometer;
        $this->mileage['output_kilometer'] = $mileage->output_kilometer;
        $this->mileage['input_date'] = $mileage->input_date;
        $this->mileage['output_date'] = $mileage->output_date;
        $this->mileage['addMileage'] = true;

        $this->mileageId = $mileage->id;
    }

    public function updateMileage(Mileage $mileage){
        $rules = [
            'mileage.input_kilometer' => 'required|numeric',
            'mileage.output_kilometer' => 'required|numeric',
            'mileage.input_date' => 'nullable|date',
            'mileage.output_date' => 'nullable|date',
        ];

        $this->validate($rules);

        $mileage->input_kilometer = $this->mileage['input_kilometer'];
        $mileage->output_kilometer = $this->mileage['output_kilometer'];
        $mileage->input_date = $this->mileage['input_date'];
        $mileage->output_date = $this->mileage['output_date'];
        $mileage->save();

        $this->emit('success');
        $this->resetVariables();
    }




    public function resetVariables()
    {
        $this->reset('mileageId', 'mileage');
        $this->resetValidation();
    }



    public function render()
    {
        if($this->carId){
            $mileages = Mileage::where('car_id', $this->carId)->orderBy('created_at', 'desc')->paginate(10);
        }else{
            $mileages = Mileage::orderBy('created_at', 'desc')->paginate(10);
        }
        return view('livewire.admin.mileages', compact('mileages'));
    }
}
