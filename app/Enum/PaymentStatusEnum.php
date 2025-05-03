<?php

namespace App\Enum;

enum PaymentStatusEnum: string
{
    case Cash = 'cash';
    case Unpaid = 'unpaid';
    case Paid = 'paid';
    case Refunded = 'refunded';
}
