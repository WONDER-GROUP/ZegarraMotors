@php
use App\Models\Invoice;
@endphp
<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Recibo</title>

    <style type="text/css">
        * {
            font-family: Verdana, Arial, sans-serif;
        }

        table {
            font-size: x-small;
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }

        .gray {
            background-color: lightgray
        }
    </style>

</head>

<body>
    <table width="100%">
        <tr>
            <td valign="top"><img src="{{ asset('images/meteor-logo.png') }}" alt="images" width="150" /></td>
            <td align="right">
                <h3>Taller automotriz {{ Invoice::NAME }}</h3>
                <pre>
                {{ Invoice::NAME }}
                NIT: {{ Invoice::NIT }}
                Dir: {{ Invoice::ADDRESS }}
                Nº Autorización: {{ Invoice::AUTHORIZATION }}
                Telf: {{ Invoice::TELEPHONE }}
                Cel.: {{ Invoice::CELLPHONE }}
            </pre>
            </td>
        </tr>

    </table>

    <table width="100%">
        <tr>
            <td><strong>Señor(es):</strong>
                {{ $order->customer->name }}
                {{ $order->customer->f_last_name }}
                {{ $order->customer->m_last_name }}
            </td>
            <td><strong>NIT/C.I.:</strong> {{ $order->customer->nit }}</td>
        </tr>

    </table>

    <br />

    <table width="100%">
        <thead style="background-color: lightgray;">
            <tr>
                <th>#</th>
                <th>Descripción</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Importe</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->products as $key => $product)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $product->name }}</td>
                    <td align="right">{{ $product->pivot->quantity }}</td>
                    <td align="right">{{ $product->pivot->price }}</td>
                    <td align="right">{{ $product->pivot->quantity * $product->pivot->price }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot style="border-top-style: solid; border-top-color: lightgray;">
            <tr>
                <td colspan="3"></td>
                <td align="right">Subtotal</td>
                <td align="right">{{ $order->total }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Descuento</td>
                <td align="right">{{ $order->discount }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">Total a pagar</td>
                <td align="right">{{ $order->payment }}</td>
            </tr>
            
            <tr>
                <td colspan="3"></td>
                <td align="right">Cambio</td>
                <td align="right">{{ $order->payment - ($order->total - $order->discount) }}</td>
            </tr>
            <tr>
                <td colspan="3"></td>
                <td align="right">TOTAL</td>
                <td align="right" class="gray">{{ $order->total - $order->discount }} Bs.</td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
