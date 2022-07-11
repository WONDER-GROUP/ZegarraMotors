<div>
    {{-- modal for add invetories --}}
    <x-jet-dialog-modal wire:model="inventory.addInventory" mt='mt-24'>
        <x-slot name="title">
            Agregar lote
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <x-jet-label for="stock" value="Stock" />
                    <x-jet-input wire:model="inventory.stock" id="stock" class="block w-full mt-1" type="number"
                        name="stock" placeholder="Ej. 52" required autofocus />
                </div>
                <div>
                    <x-jet-label for="lot" value="Lote" />
                    <x-jet-input wire:model="inventory.lot" id="lot" class="block w-full mt-1" type="number"
                        name="lot" placeholder="Ej. 41544686" required autofocus />
                </div>
                <div>
                    <x-jet-label for="purchase_price" value="Precio de compra" />
                    <x-jet-input wire:model="inventory.purchase_price" id="purchase_price" class="block w-full mt-1"
                        type="number" min="0" max="10000" name="purchase_price" placeholder="30" required
                        autofocus />
                </div>
                <div>
                    <x-jet-label for="sale_price" value="Precio de venta" />
                    <x-jet-input wire:model="inventory.sale_price" id="sale_price" class="block w-full mt-1"
                        type="number" min="0" max="10000" name="sale_price" placeholder="32.50" required
                        autofocus />
                </div>
                <div>
                    <x-jet-label for="exp_date" value="Fecha de expiración" />
                    <x-jet-input wire:model="inventory.exp_date" id="exp_date" class="block w-full mt-1" type="date"
                        name="exp_date" placeholder="32.50" required autofocus />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="saveInventory" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
