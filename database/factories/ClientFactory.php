<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            "document_id"=>$this->faker->unique()->numberBetween(1, 20),
            "name"=>$this->faker->name(),
            "email" => $this->faker->email(),
            "phone"=>$this->faker->phoneNumber(),

        ];
    }
}
