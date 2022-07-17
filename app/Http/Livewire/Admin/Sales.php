<?php

namespace App\Http\Livewire\Admin;

use App\Models\Order;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\App;

class Sales extends Component
{
    use WithPagination;

    public function printInvoice(Order $order)
    {
        $pdf = \PDF::loadView('pdf.invoice', [
            'order' => $order,
        ])->setPaper('letter', 'portrait')->output();

        return response()->streamDownload(
            fn () => print($pdf),
            'Recibo-' . now() . '.pdf'
        );
    }

    public function render()
    {
        $sales = Order::orderBy('created_at', 'desc')->paginate(8);

        return view('livewire.admin.sales', compact('sales'));
    }
}
