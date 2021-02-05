<?php


function create($class, $attributes = [], $times = null)
{
    return $class::factory($times)->create($attributes);
}


function make($model, $attributes = [], $times = null)
{
    return $model->factory($times)->make($attributes);
}
