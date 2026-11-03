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
        .info {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="ticket">
        <h4>Numero de orden: {{ $order->id }}</h4>
        <div class="info">
            <h3>Informacion de la compañia</h3>
            <div>Nombre: Ecommerce SAE</div>
            <div>RUC: 12345678-9</div>
            <div>Direccion: Calle 123, Asunción, Paraguay</div>
            <div>Telefono: 0972226375</div>
            <div>Correo: info@ecommerce.com</div>
        </div>
        <div class="info">
            <h3>Datos del cliente</h3>
            <div>Nombre: Ecommerce SAE</div>
            <div>RUC: 12345678-9</div>
            <div>Direccion: Calle 123, Asunción, Paraguay</div>
            <div>Telefono: 0972226375</div>
            <div>Correo: info@ecommerce.com</div>
        </div>
    </div>
</body>
</html>