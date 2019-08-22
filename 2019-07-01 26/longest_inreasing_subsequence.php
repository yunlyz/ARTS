<?php
/**
 * User: Yun Lv(yunlv.go@gmail.com)
 * Date: 2019-07-03 16:07
 */

function longest_increasing_subsequence(array $nums)
{
    $states = [];

    $states[0][] = [];
    $states[0][] = [$nums[0]];

    for ($i = 1; $i < count($nums); $i++) {
        for ($j = 0; $j < count($states[$i - 1]); $j++) {
            $states[$i][] = $states[$i - 1][$j];  // 不加入
            if (end($states[$i - 1][$j]) <= $nums[$i]) {  // 加入
                $states[$i][] = array_push($states[$i - 1][$j], $nums[$i]);
            }
        }
    }

    $max = 0;
    foreach ($states[count($nums)] as $state) {
        $max = max($max, count($state));
    }

    return $max;
}
