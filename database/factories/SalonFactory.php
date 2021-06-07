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
            'cif' => $this->faker->randomElement(["A", "B", "C", "D", "E", "F", "G", "H", "K", "L", "M", "N", "P", "Q", "S"])
                . $this->faker->numberBetween(10, 99)
                . $this->faker->randomNumber(5, true)
                . $this->faker->regexify('[A-Z]'),
            'employees' => $this->faker->randomDigitNotNull,
            'address' => $this->faker->streetAddress,
            'city' => $this->faker->city,
            'postal_code' => $this->faker->postcode,
            'description' => $this->faker->paragraph,
            'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'timetable_id' => 1,
            'user_id' => 2,
            'activity_id' => 1,
        ];
    }
}
