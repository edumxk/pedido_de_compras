<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->email,
            'call' => $this->faker->phoneNumber,
            'whatsapp' => $this->faker->phoneNumber,
            'supplier_id' => Supplier::factory(),
        ];
    }
}
