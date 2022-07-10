<div x-data>
    <x-notification-message on="success">
        <x-success-message />
    </x-notification-message>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Productos
        </h2>
    </x-slot>

    <div class="py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-jet-button wire:click="$set('product.addProduct', true)">
            Crear nuevo
        </x-jet-button>

        <div class="mt-4 overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="grid py-2 overflow-x-auto">
                <table class="min-w-full text-sm divide-y divide-gray-200 table-auto">
                    <thead>
                        <tr>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Nombre
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Marca
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Presentación
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Stock
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
                        @foreach ($products as $product)
                            <tr>
                                <td class="p-4 text-gray-700 whitespace-nowrap">{{ $product->name }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $product->branch }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $product->presentation->name }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $product->stock }}
                                </td>
                                <td class="px-2 w-14">
                                    <div class="flex items-center -space-x-4 hover:space-x-1">
                                        <button wire:click="editProduct({{ $product->id }})"
                                            class="z-20 block p-4 transition-all bg-green-200 border-2 border-white rounded-full text-dark-700 active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                                            type="button">
                                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                            </svg>
                                        </button>

                                        <button wire:click="editProduct({{ $product->id }})"
                                            class="z-20 block p-4 transition-all bg-green-200 border-2 border-white rounded-full text-dark-700 active:bg-blue-50 hover:scale-110 focus:outline-none focus:ring"
                                            type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                            </svg>
                                        </button>

                                        <button wire:click="deleteProduct({{ $product->id }})"
                                            class="z-30 block p-4 transition-all bg-red-200 border-2 border-white rounded-full text-dark-700 hover:scale-110 focus:outline-none focus:ring active:bg-red-50"
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
                <div class="p-4 mt-4">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

    {{-- modal for add products --}}
    <x-jet-dialog-modal wire:model="product.addProduct" mt='mt-24'>
        <x-slot name="title">
            Agregar producto
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <x-jet-label for="product" value="Nombre" />
                    <x-jet-input wire:model="product.name" id="name" class="block w-full mt-1" type="text"
                        name="product" placeholder="Ej. Aceite para motor" required autofocus />
                </div>
                <div>
                    <x-jet-label for="branch" value="Marca" />
                    <x-jet-input wire:model="product.branch" id="branch" class="block w-full mt-1" type="text"
                        name="branch" placeholder="Ej. Castrol" required autofocus />
                </div>
                <div>
                    <x-jet-label for="name" value="Presentación" />
                    <x-lwa::autocomplete class="block w-full mt-1" name="presentation-name" wire:model-text="name"
                        wire:model-id="presentationId" wire:model-results="presentations" :options="[
                            'text' => 'name',
                            'allow-new' => 'true',
                        ]" />
                </div>

            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="saveProduct()" wire:loading.attr="disabled">
                Guardar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>

    {{-- modal for edit --}}
    <x-jet-dialog-modal wire:model="product.editProduct" mt='mt-24'>
        <x-slot name="title">
            Actualizar cliente {{ $presentationId }}
        </x-slot>

        <x-slot name="content">
            <x-jet-validation-errors class="mb-4" />

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <x-jet-label for="product" value="Nombre" />
                    <x-jet-input wire:model="product.name" id="product" class="block w-full mt-1" type="text"
                        name="product" placeholder="Ej. Aceite para motor" required autofocus />
                </div>
                <div>
                    <x-jet-label for="branch" value="Marca" />
                    <x-jet-input wire:model="product.branch" id="branch" class="block w-full mt-1" type="text"
                        name="branch" placeholder="Ej. Castrol" required autofocus />
                </div>
                <div>
                    <x-jet-label for="name" value="Presentación" />
                    <x-lwa::autocomplete class="block w-full mt-1" name="presentation-name" wire:model-text="name"
                        wire:model-id="presentationId" wire:model-results="presentations" :options="[
                            'text' => 'name',
                            'allow-new' => 'true',
                        ]" />
                </div>
            </div>
        </x-slot>

        <x-slot name="footer">
            <x-jet-button wire:click="resetVariables" class="mr-4" wire:loading.attr="disabled">
                {{ __('Cancel') }}
            </x-jet-button>
            <x-jet-button wire:click="updateProduct('{{ $productId }}')" wire:loading.attr="disabled">
                Actualizar
            </x-jet-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
