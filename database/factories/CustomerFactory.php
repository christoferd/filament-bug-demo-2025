<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $addresses = [];
        // Create 1-2 records per customer
        $numContacts = fake()->numberBetween(2, 3);
        for($i = 1; $i <= $numContacts; $i++)
        {
            $addresses[] = (new AddressFactory())->definition();
        }

        return [
            'status_id'          => rand(1, 20),
            'first_name'         => fake()->firstName(),
            'last_name'          => fake()->lastName(),
            'shipping_addresses' => $addresses,
        ];
    }
}
