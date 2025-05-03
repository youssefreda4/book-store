<?php

namespace Database\Seeders;

use App\Models\ShippingArea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ShippingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $shippingAreas = [
            ['name' => 'Cairo', 'fee' => 10.50],
            ['name' => 'Elenia', 'fee' => 15.75],
            ['name' => 'Asyout', 'fee' => 12.30],
            ['name' => 'Bani Sweef', 'fee' => 8.95],
            ['name' => 'Alex', 'fee' => 14.20],
        ];

        foreach ($shippingAreas as $area) {
            ShippingArea::create($area);
        }
    }
}
