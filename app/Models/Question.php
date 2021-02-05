<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    //------> 模型关联

    /**
     * @description hasMany 问题
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     * @author CuratorC
     * @date 2021/2/5
     */
    public function answers(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Answer::class);
    }

    //------> scope

    /**
     * @description 已发布的问题
     * @param $query
     * @return mixed
     * @author CuratorC
     * @date 2021/2/5
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * @description 标记为最佳答案
     * @param $answer
     * @author CuratorC
     * @date 2021/2/5
     */
    public function markAsBestAnswer($answer)
    {
        $this->update([
            'best_answer_id'    => $answer->id
        ]);
    }
}
