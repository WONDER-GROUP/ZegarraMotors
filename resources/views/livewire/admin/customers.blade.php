<div x-data>
    <x-notification-message on="success">
        <x-success-message />
    </x-notification-message>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Clientes
        </h2>
    </x-slot>

    <div class="py-4 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <x-jet-button @click="$wire.emit('openModal')">
            Crear nuevo
        </x-jet-button>


        <div class="mt-4 bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="overflow-x-auto grid py-2">
                <table class="table-auto min-w-full text-sm divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Nombres
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Apellido Paterno
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Apellico Materno
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Nit
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Celular
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Direccion
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
                        @foreach ($customers as $customer)
                            <tr>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $customer->name }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $customer->f_last_name }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $customer->m_last_name }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $customer->nit }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $customer->cellphone }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $customer->address }}</td>
                                <td>
                                    <div class="flex items-center -space-x-4 hover:space-x-1">
                                        <button wire:click="editCustomer({{ $customer->id }})"
                                            class="z-20 block p-4 text-dark-700 transition-all bg-green-200 border-2 border-white rounded-full active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                                            type="button">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <button wire:click="deleteCustomer({{ $customer->id }})"
                                            class="z-30 block p-4 text-dark-700 transition-all bg-red-200 border-2 border-white rounded-full hover:scale-110 focus:outline-none focus:ring active:bg-red-50"
                                            type="button">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="mt-4 p-4">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>    

    {{-- modal for edit --}}
    <x-jet-dialog-modal wire:model="customer.edit" mt='mt-24'>
        <x-slot name="title">
            Actualizar cliente
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
                    <x-jet-label for="nit" value="C.I./NIT" />
                    <x-jet-input wire:model="customer.nit" id="nit" class="block mt-1 w-full" type="text" name="nit"
                        placeholder="Ej. 96584523" required autofocus />
                </div>

                <div>
                    <x-jet-label for="cellphone" value="Teléfono" />
                    <x-jet-input wire:model="customer.cellphone" id="cellphone" class="block mt-1 w-full" type="text" name="cellphone"
                        placeholder="Ej. 74859621" required autofocus />
                </div>
                <div>
                    <x-jet-label for="address" value="Dirección" />
                    <x-jet-input wire:model="customer.address" id="address" class="block mt-1 w-full" type="text" name="nit"
                        placeholder="Ej. Calle xx" required autofocus />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="updateCustomer('{{ $customerId }}')" wire:loading.attr="disabled">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
