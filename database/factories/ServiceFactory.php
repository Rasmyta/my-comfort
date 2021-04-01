<?php

namespace Database\Factories;

use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
            'duration' => $this->faker->randomElement([1.3, 1, 0.3]),
            'category' => $this->faker->randomElement(['Pelo', 'Facial', 'Masaje', 'Uñas']),
            'description' => $this->faker->sentence,
            'price' => $this->faker->randomFloat(2, 10, 50),
            'salon_id' => 1
        ];
    }
}
