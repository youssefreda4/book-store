<?php

namespace Database\Seeders;

use App\Enum\OrderStatusEnum;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->withBooks()->VisaPaid()->count(200)->create();
        Order::factory()->withBooks()->VisaUnpaid()->count(50)->create();
        Order::factory()->withBooks()->VisaRefunded()->count(100)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Cancelled)->cash()->count(50)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Confirmed)->cash()->count(200)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Pending)->cash()->count(200)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Delivered)->cash()->count(200)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Delivered)->previousWeeks()->count(200)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Cancelled)->previousWeeks(6)->count(20)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Delivered)->previousMonths(5)->count(10)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Delivered)->previousMonths(4)->count(10)->create();
        Order::factory()->withBooks()->status(OrderStatusEnum::Delivered)->previousMonths(6)->count(10)->create();
    }
}
