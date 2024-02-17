<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Promotion;

class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Promotion::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
        ];
    }
}
