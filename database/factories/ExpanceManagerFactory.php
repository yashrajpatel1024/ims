<?php

namespace Database\Factories;

use App\Models\ExpanceManager;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpanceManagerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ExpanceManager::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'catagories' => $this->faker->word,
            'current_balance' => $this->faker->numberBetween($min = 1000, $max = 9000),
        ];
    }
}
