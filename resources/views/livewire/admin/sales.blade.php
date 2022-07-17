<div>
    <x-notification-message on="success">
        <x-success-message />
    </x-notification-message>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Ventas
        </h2>
    </x-slot>

    <div class="py-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <x-button-link href="{{ route('admin.salesCreate') }}">
            Crear nueva venta
        </x-button-link>

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
                                    Vendedor
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Pago
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Descuento
                                </div>
                            </th>
                            <th class="p-4 font-medium text-left text-gray-900 whitespace-nowrap">
                                <div class="flex items-center">
                                    Total
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
                        @foreach ($sales as $sale)
                            <tr>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $sale->customer->name }}
                                    {{ $sale->customer->f_last_name }}
                                    {{ $sale->customer->m_last_name }}</td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $sale->user->people->name }}
                                    {{ $sale->user->people->f_last_name }}
                                    {{ $sale->user->people->m_last_name }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $sale->payment }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $sale->discount }}
                                </td>
                                <td class="p-4 text-gray-700 whitespace-nowrap">
                                    {{ $sale->total }}
                                </td>
                                <td class="px-2 w-14">
                                    <div class="grid justify-center">
                                        <svg wire:click="printInvoice({{ $sale->id }})" xmlns="http://www.w3.org/2000/svg"
                                            class="w-6 h-6 text-green-700 cursor-pointer" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M17 17h2a 2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
                                        </svg>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="p-4 mt-4">
                    {{ $sales->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
