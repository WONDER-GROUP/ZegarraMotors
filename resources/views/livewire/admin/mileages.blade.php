<div>
    <x-notification-message on="success">
        <x-success-message />
    </x-notification-message>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Coches
        </h2>
    </x-slot>

    <div class="py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="mt-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="grid py-2 overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200 table-auto">
                    <thead>
                        <tr>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Coche
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Kilometraje de Entrada
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Kilometraje de Salida
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Fecha de Entrada
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Fecha de Salida
                                </div>
                            </th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-100">
                        @foreach ($mileages as $mileage)
                            <tr>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $mileage->car->number_plate }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $mileage->input_kilometer }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $mileage->output_kilometer }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $mileage->input_date }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $mileage->output_date }}
                                </td>
                                <td class="px-2 w-14">
                                    <div class="flex items-center -space-x-4 hover:space-x-1">
                                        <button wire:click="editMileage({{ $mileage->id }})"
                                            class="z-20 block p-4 transition-all bg-green-200 border-2 border-white rounded-full text-dark-700 active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                                            type="button">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        
                                        <p class="z-30 block p-4 transition-all bg-gray-200 border-2 border-white rounded-full text-dark-700 hover:scale-110 focus:outline-none focus:ring active:bg-gray-50"
                                            type="button">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </p>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4 mt-4">
                    {{-- {{ $inventories->links() }} --}}
                </div>
            </div>
        </div>
    </div>

    {{-- modal for edit mileage --}}
    <x-jet-dialog-modal wire:model="mileage.addMileage" mt='mt-24'>
        <x-slot name="title">
            Agregar Kilometraje
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <x-jet-label for="input_kilometer" value="Kilometraje de Entrada" />
                    <x-jet-input wire:model="mileage.input_kilometer" id="input_kilometer" class="block w-full mt-1" type="number"
                        name="input_kilometer" placeholder="Ej. 52" required autofocus />
                </div>
                <div>
                    <x-jet-label for="output_kilometer" value="Kilometraje de Salida" />
                    <x-jet-input wire:model="mileage.output_kilometer" id="output_kilometer" class="block w-full mt-1" type="number"
                        name="output_kilometer" placeholder="Ej. 67" required autofocus />
                </div>
                <div>
                    <x-jet-label for="input_date" value="Fecha de ingreso" />
                    <x-jet-input wire:model="mileage.input_date" id="input_date" class="block w-full mt-1"
                        type="date" name="input_date" placeholder="32.50" required autofocus />
                </div>
                <div>
                    <x-jet-label for="output_date" value="Fecha de salida" />
                    <x-jet-input wire:model="mileage.output_date" id="output_date" class="block w-full mt-1"
                        type="date" name="output_date" placeholder="32.50" required autofocus />
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="updateMileage({{ $mileageId }})" wire:loading.attr="disabled">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
