<?php

namespace App\Exports;

use App\Models\Order;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings, WithMapping, WithStyles
{
    public function collection()
    {
        return Order::with(['user', 'shippingArea'])->get();
    }

    public function headings(): array
    {
        return [
            'id',
            'number',
            'user_id',
            'shipping_area_id',
            // 'Shipping Area (EN)',
            // 'Shipping Area (AR)',
            'status',
            'payment_status',
            'payment_type',
            'total',
            'tax_amount',
            'transaction_reference',
            'address',
            'created_at',
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->number,
            $order->user_id,
            $order->shipping_area_id,
            // optional($order->shippingArea)?->getTranslation('name', 'en'),
            // optional($order->shippingArea)?->getTranslation('name', 'ar'),
            $order->status->value,
            $order->payment_status->value,
            $order->payment_type->value,
            $order->total,
            $order->tax_amount,
            $order->transaction_reference,
            $order->address,
            $order->created_at,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => ['fillType' => 'solid', 'startColor' => ['rgb' => '4F81BD']],
                'alignment' => ['horizontal' => 'center'],
            ],
            'A:Z' => [
                'alignment' => ['horizontal' => 'center', 'vertical' => 'center'],
            ],
        ];
    }
}
