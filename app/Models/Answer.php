<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //------> 模型关联
    public function question(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    /**
     * @description 是否为最佳答案
     * @return bool
     * @author CuratorC
     * @date 2021/2/5
     */
    public function isBest(): bool
    {
        return $this->id == $this->question->best_answer_id;
    }
}
