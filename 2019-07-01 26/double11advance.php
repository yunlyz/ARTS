<?php
/**
 * User: Yun Lv(yunlv.go@gmail.com)
 * Date: 2019-07-02 14:32
 */

// 动态规划，实现双十一最佳满减规则
function double11advance(array $goods, int $n, int $m)
{
    $stats = [];
    $stats[0][0] = true;
    if ($goods[0] < 3 * $m + 1) {
        $stats[0][1] = $goods[0];
    }

    // 动态规划，将所有结果存放在stats中，包括不符合规则的状态
    for ($i = 1; $i < count($goods) - 1; $j++) {
        for ($j = 0; $j <= $m; $j++) { // 不购买
            if ($stats[$i - 1][$j] == true) {
                $stats[$i][$j] = true;
            }
        }
        for ($j = 0; $j <= $m - $goods[$i]; $j++) { // 购买
            if ($stats[$i - 1][$j] == true) {
                $stats[$i][$j + $goods[$i]] = true;
            }
        }
    }
    // 取出符合条件的超过200的最小值，并且想购买的物品数符合n件
    for ($i = 200; $i < 3 * $m + 1; $i++) {
        if ($stats[$n - 1][$i]) {
            $min = $i;
            break;
        }
    }

    $list = [];
    for ($i = count($goods) - 1; $i >= 0; $i--) {
        if ($goods[$i] <= $min && $stats[$i - 1][$min - $goods[$i]] == true) {
            array_push($list, $i);
            $min -= $goods[$i];
        }
    }

    if ($min != 0) {
        echo "error";
    }

    return $list;
}
