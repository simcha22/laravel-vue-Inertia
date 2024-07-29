<?php

namespace Database\Factories;

use App\Models\Exercise;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Result>
 */
class ResultFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'reps_type' => $this->faker->randomElement(['constant','variable']),
            'rehearsals' => $this->faker->randomElement(['8#8#6#4#2#2', '10#8#6#4#2#1', '5#4#3#1#1#1']),
            'weights' => $this->faker->randomElement(['50#55#60#65#70#75', '60#65#70#75#80#85', '70#75#80#85#90#95']),
            'rounds' => 6,
            'user_id' => $this->faker->randomElement(User::pluck('id')->toArray()),
            'exercise_id' => $this->faker->randomElement(Exercise::pluck('id')->toArray()),
        ];
    }
}
