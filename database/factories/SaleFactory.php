<?php

namespace Database\Factories;

use App\Models\Sale;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale>
 */
class SaleFactory extends Factory
{
    protected $model = Sale::class;

    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'fecha' => $this->faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
            'total' => 0,
        ];
    }
}
