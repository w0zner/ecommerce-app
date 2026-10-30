<?php
namespace App\Enums;

enum OrderStatus: int
{
    case Pendiente = 1;
    case Procesando = 2;
    case Enviado = 3;
    case Completado = 4;
    case Cancelado = 5;
     case Fallido = 6;
    case Devuelto = 7;
   
}
