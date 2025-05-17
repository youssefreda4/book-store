<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShippingAreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('shipping_areas')->insert([
            [
                'name' => json_encode(['en' => 'Cairo', 'ar' => 'القاهرة']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Alexandria', 'ar' => 'الإسكندرية']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Giza', 'ar' => 'الجيزة']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Port Said', 'ar' => 'بورسعيد']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Suez', 'ar' => 'السويس']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Mansoura', 'ar' => 'المنصورة']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Tanta', 'ar' => 'طنطا']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Asyut', 'ar' => 'أسيوط']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Faiyum', 'ar' => 'الفيوم']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Zagazig', 'ar' => 'الزقازيق']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Ismailia', 'ar' => 'الإسماعيلية']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Luxor', 'ar' => 'الأقصر']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Aswan', 'ar' => 'أسوان']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Minya', 'ar' => 'المنيا']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Beni Suef', 'ar' => 'بني سويف']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Qena', 'ar' => 'قنا']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Sohag', 'ar' => 'سوهاج']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Kafr El Sheikh', 'ar' => 'كفر الشيخ']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Damietta', 'ar' => 'دمياط']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Beheira', 'ar' => 'البحيرة']),
                'fee' => random_int(1, 50),
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
