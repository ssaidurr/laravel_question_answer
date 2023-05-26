<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
namespace Database\Factories;
use App\Models\Question;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    protected $model = Question::class;

    public function definition()
    {
        $title = rtrim($this->faker->sentence(rand(5, 10)), ".");
        return [
            'title' => $title,
            'slug' => str::slug($title),
            'body' => $this->faker->paragraphs(rand(3, 7), true),
            'answers_count' => rand(0, 0),
            'votes_count' => rand(0, 0),
        ];
    }
}
