<?php
/**
 * User: Yun Lv(yunlv.go@gmail.com)
 * Date: 2019-07-01 14:48
 */

function knapsack(array $weights, $n, $w)
{
    $status = [];
    $status[0][0] = true;
    if ($weights[0] <= $w) {
        $status[0][$weights[0]] = true;
    }
    for ($i = 1; $i < $n; $i++) {
        for ($j = 0; $j < $w; $w++) { // 不装入背包
            if ($status[$i - 1][$j] === true) {
                $status[$i][$j] = true;
            }
        }
        for ($j = 0; $j < $w - $weights[$i]; $w++) { // 装入背包
            if ($status[$i - 1][$j] === true) {
                $status[$i][$weights[$i] + $j] = true;
            }
        }
    }

    for ($i = $n; $i >= 0; $i--) {
        if ($status[$n - 1][$i] === true) {
            return $i;
        }
    }
    return 0;
}