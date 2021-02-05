<?php

namespace Database\Factories;

use App\Models\Question;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class QuestionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Question::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id'   => function() {
            return User::factory()->create()->id;
            },
            'title' => $this->faker->sentence,
            'content'   => $this->faker->sentence,
        ];
    }

    /**
     * 发布
     * @return QuestionFactory
     */
    public function published(): QuestionFactory
    {
        return $this->state([
            'published_at'  => Carbon::parse('-1 week')
        ]);
    }
    /**
     * 发布
     * @return QuestionFactory
     */
    public function unpublished(): QuestionFactory
    {
        return $this->state([
            'published_at'  => null
        ]);
    }
}
