<?php

namespace Tests\Unit;

use App\Models\Answer;
use App\Models\Question;
use Tests\TestCase;

class AnswerTest extends TestCase
{

    /**
     * @test
     * @description isBest()
     * @author CuratorC
     * @date 2021/2/5
     */
    public function is_knows_if_it_is_the_best()
    {
        $answer = create(Answer::class);

        $this->assertFalse($answer->isBest());
        $answer->question->update(['best_answer_id'=>$answer->id]);
        $this->assertTrue($answer->isBest());
    }

    /**
     * @test
     * @description question
     * @author CuratorC
     * @date 2021/2/5
     */
    public function an_answer_belongs_to_a_question()
    {
        $answer = create(Answer::class);
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Relations\BelongsTo', $answer->question());
    }

    /**
     * @test
     * @description markAsBestAnswer
     * @author CuratorC
     * @date 2021/2/5
     */
    public function can_mark_an_answer_as_best()
    {
        $question = create(Question::class, ['best_answer_id'=> null]);
        $answer = create(Answer::class, ['question_id'=>$question->id]);
        $question->markAsBestAnswer($answer);

        $this->assertEquals($question->best_answer_id, $answer->id);
    }
}
