<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\WarrantyPolicy;

class WarrantyPolicyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = WarrantyPolicy::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(3, true),
            'content' => $this->faker->paragraph,
        ];
    }
}
