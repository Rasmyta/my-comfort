<?php

namespace Database\Factories;

use App\Models\Salon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class SalonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Salon::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'activity' => $this->faker->randomElement([
                'Peluquería', 'Barbería', 'Centro de Depilación', 'Centro de Estética', 'Centro de Manicura', 'Masajes'
            ]),
            'employees' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'description' => $this->faker->paragraph,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'timetable_id' => 1,
            'user_id' => 2,
        ];
    }
}
