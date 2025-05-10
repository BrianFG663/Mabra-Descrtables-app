<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tipos = ['Vaso descartable', 'Bolsa plástica', 'Bandeja de telgopor', 'Globo decorativo', 'Cubiertos de plástico', 'Servilletas de papel', 'Manteles descartables', 'Sorbetes', 'Platos descartables', 'Guantes descartables'];

        $nombre = $this->faker->randomElement($tipos);
        $descripcion = "Paquete de " . $this->faker->numberBetween(10, 100) . " unidades de $nombre";

        return [
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $this->faker->randomFloat(2, 0.50, 15.00),
            'stock' => $this->faker->numberBetween(0, 500),
        ];
    }
}
