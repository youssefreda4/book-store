<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AuthorBookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            [
                'name' => json_encode(['en' => 'William Shakespeare', 'ar' => 'ويليام شكسبير']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Agatha Christie', 'ar' => 'أجاثا كريستي']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'J.K. Rowling', 'ar' => 'جيه كيه رولينج']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'George Orwell', 'ar' => 'جورج أورويل']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Ernest Hemingway', 'ar' => 'إرنست همنغواي']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Mark Twain', 'ar' => 'مارك توين']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Jane Austen', 'ar' => 'جين أوستن']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Leo Tolstoy', 'ar' => 'ليو تولستوي']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Fyodor Dostoevsky', 'ar' => 'فيودور دوستويفسكي']),
                'created_at' => Carbon::now(),
            ],
            [
                'name' => json_encode(['en' => 'Gabriel Garcia Marquez', 'ar' => 'غابرييل غارسيا ماركيز']),
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
