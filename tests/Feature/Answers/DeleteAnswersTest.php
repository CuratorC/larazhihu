<?php

namespace Tests\Feature\Answers;

use App\Models\Answer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteAnswersTest extends TestCase
{

    /**
     * @test
     * @description 未授权用户无法删除答案
     * @author CuratorC
     * @date 2021/2/5
     */
    public function guests_cannot_delete_answers()
    {
        $this->withExceptionHandling();
        $answer = create(Answer::class);

        $this->delete(route('answers.destroy', ['answer'=> $answer]))
            ->assertRedirect('login');
    }

    /**
     * @test
     * @description
     * @author CuratorC
     * @date 2021/2/5
     */
    public function unauthorized_users_cannot_delete_answers()
    {
        $this->signIn()->withExceptionHandling();

        $answer = create(Answer::class);

        $this->delete(route('answers.destroy', ['answer'=>$answer]))
            ->assertStatus(403);
    }

    /**
     * @test
     * @description 已登录用户可以删除回答
     * @author CuratorC
     * @date 2021/2/5
     */
    public function authorized_users_can_delete_answers()
    {
        $this->signIn();

        $answer = create(Answer::class, ['user_id' => auth()->id()]);
        $this->delete(route('answers.destroy', ['answer'=>$answer]))
            ->assertStatus(302);
        $this->assertDatabaseMissing('answers', ['id'=>$answer->id]);
    }
}
