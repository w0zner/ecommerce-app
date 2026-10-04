<?php
namespace App\Enums;

use Illuminate\Support\Enum;

enum TypeOfDocuments: int
{
    case CI = 1;
    case RUC = 2;
}
