<?php

/**
 * @description 将多维数组转换为一维数组
 * @param $arr
 * @param array $return
 * @return array
 * @author CuratorC
 * @date 2021/2/5
 */
function arrayToDimension($arr, $return = []): array
{
    if (isDimensions($arr)) {
        // 是多维数组，对其中每一位都调用变换
        foreach ($arr as $item) {
            $return = arrayToDimension($item, $return);
        }
    } else {
        // 不是多维，将 arr 并入 return ,返回 return
        $return = array_merge($return, $arr);

    }
    return $return;
}


function isDimensions($arr): bool
{
    return !(count($arr) == count($arr, 1));
}
