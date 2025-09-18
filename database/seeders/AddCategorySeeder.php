<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("productcategory")->insert([
            [
                "category_name" => "Electronics"
            ],
            [
                "category_name" => "TVs & Appliances"
            ],
            [
                "category_name" => "Men"
            ],
            [
                "category_name" => "Women"
            ],
            [
                "category_name" => "Baby & Kids"
            ],
            [
                "category_name" => "Home & Furniture"
            ],
            [
                "category_name" => "Sports, Books & More"
            ],
        ]);
    }
}
