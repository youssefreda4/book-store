<?php

namespace Database\Seeders;

use App\Models\BookInteraction;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookInteractionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BookInteraction::factory(200)->create();
    }
}
