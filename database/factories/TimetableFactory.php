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
            'monday' => '11:00–20:00',
            'tuesday' => '11:00–20:00',
            'wednesday' => '11:00–20:00',
            'thursday' => '11:00–20:00',
            'friday' => '11:00–20:00',
            'saturday' => '11:00–20:00',
            'sunday' => 'closed'
        ];
    }
}
