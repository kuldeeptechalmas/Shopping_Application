<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Add_Coupen_Seed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("coupen")->insert([
            [
                "name"=>"HDFC",
                "code"=>"123hdfc",
                "value"=>"5% cashback on Flipkart HDFC Credit Card upto ₹4,000 per calendar quarter"
            ],
            [
                "name"=>"SBI",
                "code"=>"123sbi",
                "value"=>"5% cashback on Flipkart SBI Credit Card upto ₹3,000 per calendar quarter"
            ],
            [
                "name"=>"AXIS",
                "code"=>"123axis",
                "value"=>"5% cashback on Axis Bank Flipkart Debit Card"
            ],

        ]);
    }
}
