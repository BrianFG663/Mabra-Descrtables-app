<?php

namespace Database\Factories;
use App\Models\Sale_detail;
use App\Models\Product;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Sale_detail>
 */
class Sale_detailFactory extends Factory
{
    protected $model = Sale_detail::class;

    public function definition()
    {
        $product = Product::inRandomOrder()->first();

        $cantidad = $this->faker->numberBetween(1, 10);
        $precio_unitario = $product->precio;

        return [
            'product_id' => $product->id,
            'cantidad' => $cantidad,
            'precio_unitario' => $precio_unitario,
        ];
    }
}
