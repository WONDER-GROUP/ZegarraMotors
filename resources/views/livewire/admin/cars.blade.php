<div x-data>
    <x-notification-message on="success">
        <x-success-message />
    </x-notification-message>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Coches
        </h2>
    </x-slot>
    <div class="py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-jet-button wire:click="$set('car.addCar', true)">
            Crear nuevo
        </x-jet-button>

            
        <div class="mt-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="grid py-2 overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200 table-auto">
                    <thead>
                        <tr>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Cliente
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Marca
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Modelo
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Color
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Placa
                                </div>
                            </th>
                            {{-- <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Descripción
                                </div>
                            </th> --}}
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Acciones
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($cars as $car)
                        
                            <tr>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $car->customer->name }} {{ $car->customer->f_last_name }} {{ $car->customer->m_last_name }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $car->brand }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $car->model }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $car->color }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $car->number_plate }}
                                </td>
                                <td class="px-2 w-14">
                                    <div class="flex items-center -space-x-4 hover:space-x-1">
                                        <button wire:click="editCar({{ $car->id }})"
                                            class="z-20 block p-4 transition-all bg-green-200 border-2 border-white rounded-full text-dark-700 active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                                            type="button">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <button wire:click="$emit('openModalMileage', {{ $car->id }})"
                                            class="z-20 block p-4 transition-all bg-green-200 border-2 border-white rounded-full text-dark-700 active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                            </svg>
                                        </button>

                                        @if ($car->mileages->count())
                                            <b class="z-30 block p-4 transition-all bg-gray-200 border-2 border-white rounded-full text-dark-700 hover:scale-110 focus:outline-none focus:ring active:bg-gray-50"
                                                type="button">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </b>

                                            <button wire:click="showMileages({{ $car->id }})"
                                                class="z-30 block p-4 transition-all bg-blue-700 border-2 border-white rounded-full text-dark-700 hover:scale-110 focus:outline-none focus:ring active:bg-blue-70"
                                                type="button">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-white"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </button>
                                        @else
                                            <button wire:click="deleteCar({{ $car->id }})"
                                                class="z-30 block p-4 transition-all bg-red-200 border-2 border-white rounded-full text-dark-700 hover:scale-110 focus:outline-none focus:ring active:bg-red-50"
                                                type="button">
                                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{-- <div class="p-4 mt-4">
                    {{ $products->links() }}
                </div> --}}
            </div>
        </div>
    </div>
    {{-- modal for add cars --}}
    <x-jet-dialog-modal wire:model="car.addCar" mt='mt-24'>
        <x-slot name="title">
            Agregar Coche
        </x-slot>
        

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />
            {{-- Begin:information about customer --}}
                
            <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label for="customer_id" value="Seleccionar cliente" />
                    <div wire:ignore>
                        <select class="block w-full " id="customer_id" wire:model="car.customer_id">
                            <option value="0" disabled selected>Seleccionar cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                    {{ $customer->f_last_name }}
                                    {{ $customer->m_last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-input-error for="customer_id" />
                </div>
            </div>        
            
            {{-- End:information about customer --}}
            <div class="grid grid-cols-2 gap-6">
                
                <div>
                    <x-jet-label for="brand" value="Marca" />
                    <x-jet-input wire:model="car.brand" id="brand" class="block w-full mt-1" type="text"
                        name="brand" placeholder="Ej. Toyota" required autofocus />
                </div>
                <div>
                    <x-jet-label for="model" value="Modelo" />
                    <x-jet-input wire:model="car.model" id="model" class="block w-full mt-1" type="text"
                        name="model" placeholder="Ej. 1996" required autofocus />
                </div>
                <div>
                    <x-jet-label for="color" value="Color" />
                    <x-jet-input wire:model="car.color" id="color" class="block w-full mt-1" type="text"
                        name="color" placeholder="Ej. Rojo" required autofocus />
                </div>
                <div>
                    <x-jet-label for="number_plate" value="Placa" />
                    <x-jet-input wire:model="car.number_plate" id="number_plate" class="block w-full mt-1" type="text"
                        name="number_plate" placeholder="Ej. 345-MRD" required autofocus />
                </div>
                {{-- <div>
                    <x-jet-label for="name" value="Presentación" />
                    <x-lwa::autocomplete class="block w-full mt-1" name="presentation-name" wire:model-text="name"
                        wire:model-id="presentationId" wire:model-results="presentations" :options="[
                            'text' => 'name',
                            'allow-new' => 'true',
                        ]" />
                </div> --}}
                
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="saveCar()" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>



    {{-- modal for edit --}}
    <x-jet-dialog-modal wire:model="car.editCar" mt='mt-24'>
        <x-slot name="title">
            Actualizar cliente
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />
            {{-- Begin:information about customer --}}
                
            {{-- <div class="grid grid-cols-2 gap-6 mb-4">
                <div>
                    <x-jet-label for="customer_id" value="Seleccionar cliente" />
                    <div wire:ignore>
                        <select class="block w-full " id="customer_id" wire:model="car.customer_id">
                            <option value="0" disabled selected>Seleccionar cliente</option>
                            @foreach ($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->name }}
                                    {{ $customer->f_last_name }}
                                    {{ $customer->m_last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <x-jet-input-error for="customer_id" />
                </div>
            </div>         --}}
            
            {{-- End:information about customer --}}
            <div class="grid grid-cols-2 gap-6">
                
                <div>
                    <x-jet-label for="brand" value="Marca" />
                    <x-jet-input wire:model="car.brand"  id="brand" class="block w-full mt-1" type="text"
                        name="brand" placeholder="Ej. Toyota" required autofocus />
                </div>
                <div>
                    <x-jet-label for="model" value="Modelo" />
                    <x-jet-input wire:model="car.model" id="model" class="block w-full mt-1" type="text"
                        name="model" placeholder="Ej. 1996" required autofocus />
                </div>
                <div>
                    <x-jet-label for="color" value="Color" />
                    <x-jet-input wire:model="car.color" id="color" class="block w-full mt-1" type="text"
                        name="color" placeholder="Ej. Rojo" required autofocus />
                </div>
                <div>
                    <x-jet-label for="number_plate" value="Placa" />
                    <x-jet-input wire:model="car.number_plate" id="number_plate" class="block w-full mt-1" type="text"
                        name="number_plate" placeholder="Ej. 345-MRD" required autofocus />
                </div>
                {{-- <div>
                    <x-jet-label for="name" value="Presentación" />
                    <x-lwa::autocomplete class="block w-full mt-1" name="presentation-name" wire:model-text="name"
                        wire:model-id="presentationId" wire:model-results="presentations" :options="[
                            'text' => 'name',
                            'allow-new' => 'true',
                        ]" />
                </div> --}}
                
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="updateCar('{{ $carId }}')" wire:loading.attr="disabled">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    @livewire('admin.add-mileage')

    



    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>


            Livewire.on('addCustomer', (id, name, f_last_name, m_last_name) => {
                $('#customer option:first').text(name + ' ' + f_last_name + ' ' + m_last_name);
                $('#customer').val(0);
                $('#customer option:selected').prop('disabled', false);
                $('#customer').select2();
                var customer = document.getElementById('customer');
                customer.options[customer.selectedIndex].value = id;
            })


        </script>
    @endpush
</div>

