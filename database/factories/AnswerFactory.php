<?php

namespace Database\Factories;
use App\Models\Answer;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnswerFactory extends Factory
{
    protected $model = Answer::class;

    public function definition()
    {
        $title = rtrim($this->faker->sentence(rand(5, 10)), ".");
        return [
            'body' => $this->faker->paragraphs(rand(3, 7), true),
            'user_id' =>  User::pluck('id')->random(),
            'votes_count' => rand(0, 0),
        ];
    }
}