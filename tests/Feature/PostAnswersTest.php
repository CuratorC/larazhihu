<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostAnswersTest extends TestCase
{

    /** @test */
    public function user_can_post_an_answer_to_a_question()
    {
        // 假设已经存在某个问题
        $question = Question::factory()->create();
        $user = User::factory()->create();

        // 然后我们触发某个路由
        $response = $this->post("/questions/{$question->id}/answers", [
            'user_id'   => $user->id,
            'content'   => 'This is an answer.'
        ]);

        $response->assertStatus(201);

        // 我们要看到预期结果
        $answer = $question->answers()->where('user_id', $user->id)->first();
        $this->assertNotNull($answer);

        $this->assertEquals(1, $question->answers()->count());

    }
}