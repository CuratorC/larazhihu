<?php

namespace Tests\Feature;

use App\Models\Question;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostAnswersTest extends TestCase
{

    /**
     * @test
     * @description 已登录用户可以回答一个已发布的问题
     * @author CuratorC
     * @date 2021/2/5
     */
    public function signed_in_user_can_post_an_answer_to_a_published_question()
    {
        // 假设已经存在某个问题
        // $question = create(Question::class);
        $question = Question::factory()->published()->create();
        $this->signIn($user = create(User::class));

        // 然后我们触发某个路由
        $response = $this->post("/questions/{$question->id}/answers", [
            'content'   => 'This is an answer.'
        ]);

        $response->assertStatus(302);

        // 我们要看到预期结果
        $answer = $question->answers()->where('user_id', $user->id)->first();
        $this->assertNotNull($answer);

        $this->assertEquals(1, $question->answers()->count());
    }

    /**
     * @test
     * @description 未登录用户不能提交回答
     * @author CuratorC
     * @date 2021/2/5
     */
    public function guests_may_not_post_an_answer()
    {
        $this->expectException('Illuminate\Auth\AuthenticationException');

        $question = Question::factory()->published()->create();

        $response = $this->post("/questions/{$question->id}/answers", [
            'content'   => 'This is an answer.'
        ]);
    }

    /**
     * @test
     * @description 不能给未发布的问题发表回答
     * @author CuratorC
     * @date 2021/2/5
     */
    public function can_not_post_an_answer_to_an_unpublished_question()
    {
        $question = Question::factory()->unpublished()->create();
        $this->signIn($user = create(User::class));

        $response = $this->withExceptionHandling()
            ->post("/questions/{$question->id}/answers", [
                'user_id'   => $user->id,
                'content'   => 'This is an answer.'
            ]);
        $response->assertStatus(404);

        $this->assertDatabaseMissing('answers', ['question_id'  => $question->id]);
        $this->assertEquals(0, $question->answers()->count());
    }

    /**
     * @test
     * @description content 是必填项
     * @author CuratorC
     * @date 2021/2/5
     */
    public function content_is_required_to_post_answers()
    {
        $this->withExceptionHandling();

        $question = Question::factory()->published()->create();
        $this->signIn($user = create(User::class));

        $response = $this->post("/questions/{$question->id}/answers", [
            'user_id'   => $user->id,
            'content'   => null
        ]);

        $response->assertRedirect();
        $response->assertSessionHasErrors('content');
    }
}
