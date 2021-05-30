<?php

namespace Database\Factories;

use App\Models\Timetable;
use Illuminate\Database\Eloquent\Factories\Factory;

class TimetableFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Timetable::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'monday_start' => '11:00',
            'monday_end' => '20:00',
            'tuesday_start' => '11:00',
            'tuesday_end' => '20:00',
            'wednesday_start' => '11:00',
            'wednesday_end' => '20:00',
            'thursday_start' => '11:00',
            'thursday_end' => '20:00',
            'friday_start' => '11:00',
            'friday_end' => '20:00',
            'saturday_start' => '11:00',
            'saturday_end' => '20:00'
        ];
    }
}
