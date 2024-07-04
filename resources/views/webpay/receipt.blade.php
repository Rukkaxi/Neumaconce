<!DOCTYPE html>
<html>
<head>
    <title>Boleta</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Boleta</h1>
    <p>Orden de Compra: {{ $order->buy_order }}</p>
    <p>Nombre del Cliente: {{ $order->user->name }}</p>
    <strong>Dirección:</strong> {{ $order->address->address1 ?? 'Freire #82' }}<br>
    <p>Tipo de Envío: {{ $order->delivery_type }}</p>
    <p>Total: {{ $order->total }}</p>
    <p>Estado: {{ $order->status }}</p>
    <h2>Productos:</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
