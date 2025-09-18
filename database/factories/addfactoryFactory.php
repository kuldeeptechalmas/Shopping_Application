<?php

namespace Database\Factories;

use App\Models\CategoryProduct;
use Illuminate\Database\Eloquent\Factories\Factory;


class addfactoryFactory extends Factory
{
   protected $model = CategoryProduct::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
        ];
    }
}
