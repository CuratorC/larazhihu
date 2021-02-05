<?php

namespace Tests\Feature;

use App\Models\Question;
use Carbon\Carbon;
use Tests\TestCase;

class ViewQuestionsTest extends TestCase
{
    /**
     * @test
     */
    public function user_can_view_questions()
    {
        // 1. 访问链接 questions
        $test = $this->get('/questions');

        // 2. 正常返回 200
        $test->assertStatus(200);
    }

    /** @test */
    public function user_can_view_a_published_question()
    {
        $question = Question::factory()->create(['published_at' => Carbon::parse('-1 week')]);

        $this->get('/questions/' . $question->id)
            ->assertStatus(200)
            ->assertSee($question->title)
            ->assertSee($question->content);
    }

    /** @test */
    public function user_cannot_view_unpublished_question()
    {
        $question = Question::factory()->create(['published_at'    => null]);

        $this->withExceptionHandling()
            ->get('/questions/' . $question->id)
            ->assertStatus(404);
    }
}
