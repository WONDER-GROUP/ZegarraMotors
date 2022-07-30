<div>
    {{-- modal for add mileages --}}
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
                        name="output_kilometer" placeholder="Ej. 41544686" required autofocus />
                </div>
                <div>
                    <x-jet-label for="input_date" value="Fecha de ingreso" />
                    <x-jet-input wire:model="mileage.input_date" id="input_date" class="block w-full mt-1" type="date"
                        name="input_date" placeholder="32.50" required autofocus />
                </div>
                <div>
                    <x-jet-label for="output_date" value="Fecha de salida" />
                    <x-jet-input wire:model="mileage.output_date" id="output_date" class="block w-full mt-1" type="date"
                        name="output_date" placeholder="32.50" required autofocus />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="saveMileage" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
