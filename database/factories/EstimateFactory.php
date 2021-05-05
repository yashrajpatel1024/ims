<?php

namespace Database\Factories;

use App\Models\Estimate;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class EstimateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Estimate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'service_id'=>Service::factory(),
            'bill_to' => $this->faker->address,
            'issue_date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'due_date' => $this->faker->date($format = 'Y-m-d', $max = '+5 years'),
            'cost' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'quantity' => $this->faker->numberBetween($min = 1, $max = 100),
            'subtotal' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'discount' => $this->faker->numberBetween($min = 10, $max = 50),
            'tax' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'total' => $this->faker->numberBetween($min = 1000, $max = 9000),
            
        ];
    }
}
