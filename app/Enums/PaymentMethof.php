<?php
namespace App\Enums;

enum PaymentMethof: int
{
    case Transferencia = 1;
    case Link_pago = 2;
    case Tarjeta = 3;
}
