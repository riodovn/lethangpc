<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TechnicalSpec;

class TechnicalSpecFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = TechnicalSpec::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'value' => $this->faker->word,
            'product_id' => \App\Models\Product::factory(),
        ];
    }
}
