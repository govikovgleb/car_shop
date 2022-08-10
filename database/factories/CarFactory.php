<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $carModels = [
            'Lexus' => [
                'ES',
                'GX'
            ],
            'Toyota' => [
                'Camry',
                'Corolla'
            ]
        ];
        $brand = array_rand($carModels);
        $model = Arr::random($carModels[$brand]);
        $engineType = Arr::random([
            'Бензин',
            'Дизель',
            'Гибрид'
        ]);
        $drive = Arr::random([
            'Полный',
            'Передний'
        ]);

        return [
            'brand' => $brand,
            'model' => $model,
            'engine_type' => $engineType,
            'drive' => $drive
        ];
    }
}
