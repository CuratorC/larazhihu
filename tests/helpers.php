<?php

/**
 * @description 创建模型
 * @param $class
 * @param array $attributes
 * @param null $times
 * @param mixed ...$states
 * @return mixed
 * @author CuratorC
 * @date 2021/2/5
 */
function create($class, $attributes = [], $times = null, ...$states)
{
    return $class::factory($times)->addStates(arrayToDimension($states))->create($attributes);
}

/**
 * @description 简易创建
 * @param $class
 * @param mixed ...$states
 * @return mixed
 * @author CuratorC
 * @date 2021/2/5
 */
function simpleCreate($class, ...$states)
{
    return create($class, [], null, $states);
}

/**
 * @description 制作
 * @param $class
 * @param array $attributes
 * @param null $times
 * @param mixed ...$states
 * @return mixed
 * @author CuratorC
 * @date 2021/2/5
 */
function make($class, $attributes = [], $times = null, ...$states)
{
    return $class::factory($times)->addStates($states)->make($attributes);
}

