@php
use App\Models\Product;
@endphp
<div x-data>
    @push('styles')
        <link href="{{ asset('css/select2.css') }}" rel="stylesheet" />
    @endpush
    @livewire('admin.add-customers')

    <x-notification-message on="success">
        <x-success-message />
    </x-notification-message>

    <x-notification-message on="errorStock">
        <x-success-message message="Stock insuficiente" />
    </x-notification-message>

    <x-notification-message on="inventoryExist">
        <x-success-message message="Este lote ya a sido añadido" icon="error" />
    </x-notification-message>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Nueva venta
        </h2>
    </x-slot>

    {{-- Begin:information about customer and products stock --}}
    <div class="py-4 mx-4 mt-4 bg-white rounded-lg shadow-lg max-w-7xl sm:px-6 lg:px-8">
        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-4">
                <x-jet-label for="customer" value="Seleccionar cliente" />
                <div wire:ignore>
                    <select class="w-full" id="customer">
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
                <x-jet-input-error for="customerId" />

                <x-jet-button @click="$wire.emit('openModal')" class="mt-4">
                    Registrar nuevo cliente
                </x-jet-button>
            </div>
            <div class="col-span-5">
                <x-jet-label for="carId" value="Seleccionar coche" />
                @if ($cars)
                    <select wire:model="carId" wire:key="carId"
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm form-control focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value selected disabled>Seleccione un coche</option>
                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}">
                                {{ $car->number_plate }}
                                {{ '(Cantidad: ' . $car->model . ')' }}
                            </option>
                        @endforeach
                    </select>
                    <x-jet-input-error for="carId" />
                @else
                    <select disabled
                        class="w-full mt-1 border-gray-300 rounded-md shadow-sm form-control focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="" selected disabled>Seleccione un coche</option>
                    </select>
                    <x-jet-input-error for="carId" />
                @endif
            </div>
            {{-- <div class="col-span-4">
                <x-jet-label for="customer" value="Seleccionar producto" />
                <div wire:ignore>
                    <select class="w-full" id="product">
                        <option value="0" disabled selected>Seleccionar coche</option>
                        @foreach ($cars as $car)
                            <option value="{{ $car->id }}">
                                {{ $car->number_plate }}
                                {{ '(' . $car->brand . ')' }}
                                {{ '(' . $car->model . ')' }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <x-jet-input-error for="productId" />
            </div> --}}
            <div class="col-span-8">
                <div class="grid grid-cols-12 gap-4">
                    <div class="col-span-5">
                        <x-jet-label for="customer" value="Seleccionar producto" />
                        <div wire:ignore>
                            <select class="w-full" id="product">
                                <option value="0" disabled selected>Seleccionar producto</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id }}">
                                        {{ $product->name }}
                                        {{ '(' . $product->branch . ')' }}
                                        {{ '(' . $product->presentation->name . ')' }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-jet-input-error for="productId" />
                    </div>
                    <div class="col-span-5">
                        <x-jet-label for="inventoryId" value="Seleccionar lote" />
                        @if ($inventories)
                            <select wire:model="inventoryId" wire:key="inventoryId"
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm form-control focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value selected disabled>Seleccione un lote</option>
                                @foreach ($inventories as $inventory)
                                    <option value="{{ $inventory->id }}">
                                        {{ $inventory->lot }}
                                        {{ '(Cantidad: ' . $inventory->stock . ')' }}
                                    </option>
                                @endforeach
                            </select>
                            <x-jet-input-error for="inventoryId" />
                        @else
                            <select disabled
                                class="w-full mt-1 border-gray-300 rounded-md shadow-sm form-control focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="" selected disabled>Seleccione un lote</option>
                            </select>
                            <x-jet-input-error for="inventoryId" />
                        @endif
                    </div>
                    <div class="col-span-2">
                        <x-jet-label for="quantity" value="Cantidad" />
                        @if ($inventoryId)
                            <x-jet-input wire:model="quantity" id="quantity" class="block w-full mt-1" type="number"
                                step="1" min="0" max="10000" name="quantity" required autofocus />
                        @else
                            <x-jet-input class="block w-full mt-1" type="number" step="1" min="0"
                                max="10000" name="quantity" required autofocus disabled />
                        @endif
                        <x-jet-input-error for="quantity" />
                    </div>
                </div>
                <x-jet-button wire:click="addProduct" class="mt-4">
                    Agregar producto
                </x-jet-button>
            </div>

        </div>
    </div>
    {{-- End:information about customer and products stock --}}

    {{-- Begin:table of products selected --}}
    <div class="py-4 mx-4 mt-4 bg-white rounded-lg shadow-lg max-w-7xl sm:px-6 lg:px-8">
        <div class="grid py-2 overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200 table-auto">
                <thead>
                    <tr>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Producto
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Lote
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Precio
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Cantidad
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Subtotal
                            </div>
                        </th>
                        <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                            <div class="flex items-center">
                                Acciones
                            </div>
                        </th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-gray-100">
                    @foreach ($listProducts as $key => $id)
                        @php
                            $product = Product::find($id);
                        @endphp
                        <tr>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                {{ $product->name }}
                                {{ ' (' . $product->presentation->name . ')' }}
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                {{ $product->inventories->find($listLots[$key])->lot }}
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                {{ $product->inventories->find($listLots[$key])->sale_price }}
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                {{ $listQuantity[$key] }}
                            </td>
                            <td class="p-4 text-gray-700 whitespace-nowrap">
                                {{ $listSubtotal[$key] }}
                            </td>
                            <td class="px-2 w-14">
                                <div wire:click="deleteProduct({{ $key }})" class="grid justify-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-500 cursor-pointer"
                                        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- End:table of products selected --}}

    {{-- Begin:information about payment --}}
    <div class="grid grid-cols-12 gap-5 mx-4 mt-4 justify-items-stretch">
        <div class="col-span-1">
            <x-jet-label for="total" value="Total" />
            <x-jet-input wire:model="total" id="total" class="block w-full mt-1" type="text" name="total"
                placeholder="Ej. Juan" required disabled />
            <x-jet-input-error for="total" />
        </div>
        <div class="col-span-1">
            <x-jet-label for="discount" value="Descuento" />
            <x-jet-input wire:model="discount" id="discount" class="block w-full mt-1" type="number"
                min="0" max="50" name="discount" required />
            <x-jet-input-error for="discount" />
        </div>
        <div class="col-span-1">
            <x-jet-label for="payment" value="Total a pagar" />
            <x-jet-input wire:model="payment" id="payment" class="block w-full mt-1" type="number"
                min="0" max="10000" name="payment" required />
            <x-jet-input-error for="payment" />
        </div>
        <div class="col-span-1">
            <x-jet-label for="change" value="Cambio" />
            <x-jet-input wire:model="change" id="change" class="block w-full mt-1" type="text" name="change"
                required disabled />
            <x-jet-input-error for="change" />
        </div>
    </div>
    {{-- ENd:information about payment --}}

    {{-- Begin:buttons for payment --}}
    <div class="mx-4 mt-4">
        <x-jet-button 
            wire:click="saveOrder"
            wire:loading.attr="disabled"
            wire:target="payment"
            disabled="{{ $buttonsPayment ? '' : 'disabled' }}">
            Registrar venta
        </x-jet-button>
        <x-button-link href="{{ route('admin.sales') }}" color="red">
            Cancelar
        </x-button-link>
    </div>
    {{-- end:buttons for payment --}}

    @push('scripts')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"
            integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            document.addEventListener('livewire:load', function() {
                $('#customer').select2();
                $('#customer').on('change', function() {
                    // @wire.set('customerId', this.value);
                    @this.customerId = this.value
                });

                $('#product').select2();
                $('#product').on('change', function() {
                    @this.productId = this.value
                });

                $('#car').select2();
                $('#car').on('change', function() {
                    @this.cartId = this.value
                });
            })

            Livewire.on('addCustomer', (id, name, f_last_name, m_last_name) => {
                $('#customer option:first').text(name + ' ' + f_last_name + ' ' + m_last_name);
                $('#customer').val(0);
                $('#customer option:selected').prop('disabled', false);
                $('#customer').select2();
                var customer = document.getElementById('customer');
                customer.options[customer.selectedIndex].value = id;
            })

            Livewire.on('clearProduct', () => {
                $('#product').val(0);
                $('#product').select2();
            })
        </script>
    @endpush
</div>
