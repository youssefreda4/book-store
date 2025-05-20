<?php

namespace App\Models;

use App\Enum\OrderStatusEnum;
use App\Enum\PaymentStatusEnum;
use App\Enum\PaymentTypeEnum;
use Carbon\Carbon;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /** @use HasFactory<\Database\Factories\OrderFactory> */
    use Filterable, HasFactory;

    protected $fillable = [
        'number',
        'shipping_fee',
        'books_total',
        'total',
        'status',
        'payment_status',
        'payment_type',
        'tax_amount',
        'transaction_reference',
        'address',
        'shipping_area_id',
        'user_id',
        'discount',
        'paymob_order_id',
    ];

    public function getRouteKeyName()
    {
        return 'number';
    }

    protected $casts = ['status' => OrderStatusEnum::class, 'payment_type' => PaymentTypeEnum::class, 'payment_status' => PaymentStatusEnum::class];

    public function shippingArea()
    {
        return $this->belongsTo(ShippingArea::class, 'shipping_area_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function books()
    {
        return $this->belongsToMany(Book::class, 'book_orders')->withPivot('applied_discount', 'price', 'quantity')->withTimestamps();
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->format('d, M Y');
    }

    public function getDiscountAttribute()
    {
        return $this->books->reduce(fn($acc, $book) => $acc + $book->pivot->applied_discount, 0);
    }

    public function getPriceBeforeDiscountAttribute()
    {
        return $this->books->reduce(fn($acc, $book) => $acc + ($book->pivot->price * $book->pivot->quantity), 0);
    }

    public function getStatusPercentageAttribute()
    {
        return match ($this->status) {
            OrderStatusEnum::Pending => 30,
            OrderStatusEnum::OutForDelivery => 60,
            OrderStatusEnum::Delivered => 100,
        };
    }

    public function statusBadge(): string
    {
        return match ($this->status->value) {
            OrderStatusEnum::Pending->value => '<span class="badge bg-warning text-dark rounded">' . __('order.status_pending') . '</span>',
            OrderStatusEnum::OutForDelivery->value => '<span class="badge bg-info text-dark rounded">' . __('order.status_out_for_delivery') . '</span>',
            OrderStatusEnum::Confirmed->value => '<span class="badge bg-primary rounded">' . __('order.status_confirmed') . '</span>',
            OrderStatusEnum::Delivered->value => '<span class="badge bg-success rounded">' . __('order.status_delivered') . '</span>',
            OrderStatusEnum::Cancelled->value => '<span class="badge bg-danger rounded">' . __('order.status_cancelled') . '</span>',
            default => '<span class="badge bg-secondary rounded">' . __('order.status_unknown') . '</span>',
        };
    }

    public function getPaymentStatusBadge(): string
    {
        return match ($this->payment_status->value) {
            PaymentStatusEnum::Cash->value => '<span class="badge bg-secondary">' . __('order.payment_status_cash') . '</span>',
            PaymentStatusEnum::Unpaid->value => '<span class="badge bg-warning text-dark">' . __('order.payment_status_unpaid') . '</span>',
            PaymentStatusEnum::Paid->value => '<span class="badge bg-success">' . __('order.payment_status_paid') . '</span>',
            PaymentStatusEnum::Refunded->value => '<span class="badge bg-info text-dark">' . __('order.payment_status_refunded') . '</span>',
            default => '<span class="badge bg-dark">' . __('order.payment_status_unknown') . '</span>',
        };
    }

    public function getPaymentTypeBadge(): string
    {
        return match ($this->payment_type->value) {
            PaymentTypeEnum::Cash->value => '<span class="badge bg-primary">' . __('order.payment_type_cash') . '</span>',
            PaymentTypeEnum::Visa->value => '<span class="badge bg-warning text-dark">' . __('order.payment_type_visa') . '</span>',
            default => '<span class="badge bg-dark">' . __('order.payment_type_unknown') . '</span>',
        };
    }
}
