<div>
    <x-jet-dialog-modal wire:model="addCustomer" mt='mt-24'>
        <x-slot name="title">
            Agregar nuevo cliente
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <x-jet-label for="name" value="Nombre" />
                    <x-jet-input wire:model="customer.name" id="name" class="block mt-1 w-full" type="text" name="name"
                        placeholder="Ej. Juan" required autofocus />
                </div>
                <div>
                    <x-jet-label for="f_last_name" value="Apellido paterno" />
                    <x-jet-input wire:model="customer.f_last_name" id="f_last_name" class="block mt-1 w-full" type="text" name="lname"
                        placeholder="Ej. Perez" required autofocus />
                </div>

                <div>
                    <x-jet-label for="m_last_name" value="Apellido materno" />
                    <x-jet-input wire:model="customer.m_last_name" id="m_last_name" class="block mt-1 w-full" type="text" name="lname"
                        placeholder="Ej. Muñoz" required autofocus />
                </div>
                <div>
                    <x-jet-label for="nit" value="C.i./NIT" />
                    <x-jet-input wire:model="customer.nit" id="nit" class="block mt-1 w-full" type="text" name="number"
                        placeholder="Ej. 96584523" required autofocus />
                </div>

                <div>
                    <x-jet-label for="cellphone" value="Teléfono" />
                    <x-jet-input wire:model="customer.cellphone" id="cellphone" class="block mt-1 w-full" type="text" name="cellphone"
                        placeholder="Ej. 74859621" required autofocus />
                </div>
                <div>
                    <x-jet-label for="address" value="Dirección" />
                    <x-jet-input wire:model="customer.address" id="address" class="block mt-1 w-full" type="text" name="address1"
                        placeholder="Ej. Calle xx" required autofocus />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="save" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
