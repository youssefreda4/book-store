<?php

namespace App\Enum;

enum PaymentTypeEnum: string
{
    case Cash = 'cash';
    case Visa = 'visa';
}
