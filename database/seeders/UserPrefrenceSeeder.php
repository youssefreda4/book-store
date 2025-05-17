<?php

namespace Database\Seeders;

use App\Models\UserPrefrence;
use Illuminate\Database\Seeder;

class UserPrefrenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPrefrence::factory(200)->create();
    }
}
