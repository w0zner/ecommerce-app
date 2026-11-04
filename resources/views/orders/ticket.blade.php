<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tiket de compra</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }
        .ticket {
            max-width: 400px;
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-bottom: 15px;
        }
        .info {
            margin-bottom: 20px;
        }
        .info div {
            margin-bottom: 5px;
        }
        .footer {
            text-align: center;
            font-weight: bold;
        }
        .text-right {
            text-align: right;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h4>Numero de orden: {{ $order->id }}</h4>
        <div class="info">
            <h3>Informacion de la Empresa</h3>
            <div>Nombre: Ecommerce SAE</div>
            <div>RUC: 12345678-9</div>
            <div>Direccion: Calle 123, Asunción, Paraguay</div>
            <div>Telefono: 0972226375</div>
            <div>Correo: info@ecommerce.com</div>
        </div>
        <div class="info">
            <h3>Datos del Cliente</h3>
            <div>Nombre: {{ $user->name ?? 'Cliente' }} {{ $user->last_name ?? '' }}</div>
            <div>RUC: {{ $user->document_number ?? '' }}</div>
            <div>Direccion: {{ $user->address ?? 'No especificado' }}</div>
            <div>Telefono: {{ $user->phone }}</div>
            <div>Correo: {{ $user->email }}</div>
        </div>
       {{--  <div class="info">
            <div class="text-right">Total Gs. {{ $order->total }}</div>
        </div> --}}
        <div class="footer">
            Gracias por su compra!
        </div>
    </div>
</body>
</html>
