<?php

namespace Database\Factories;

use App\Models\Payment;
use App\Models\Invoice;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Payment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::factory(),
            'amount' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'due' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'mode' => $this->faker->word,
            'date' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
            'duedate' => $this->faker->date($format = 'Y-m-d', $max = '+5 years'),

        ];
    }
}
