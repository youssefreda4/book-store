<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PublisherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('publishers')->insert([
            [
                'name' => json_encode(['en' => 'The Times', 'ar' => 'التايمز']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'The Guardian', 'ar' => 'الغارديان']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'BBC News', 'ar' => 'بي بي سي نيوز']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Al Jazeera', 'ar' => 'الجزيرة']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'CNN', 'ar' => 'سي إن إن']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Reuters', 'ar' => 'رويترز']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Bloomberg', 'ar' => 'بلومبيرغ']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'New York Times', 'ar' => 'نيويورك تايمز']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Washington Post', 'ar' => 'واشنطن بوست']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Forbes', 'ar' => 'فوربس']),
                'created_at' => Carbon::now(),
            ],

        ]);
    }
}
