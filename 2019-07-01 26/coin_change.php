<?php
/**
 * User: Yun Lv(yunlv.go@gmail.com)
 * Date: 2019-07-03 10:43
 *
 * @param array $coins
 * @param       $money
 *
 * @return int|mixed
 */

function coinChange(array $coins, $money)
{
    if ($money <= 0) {
        return 0;
    }
    if ($money - 1 >= 0) {
        $one = coinChange($coins, $money - 1);
    }
    if ($money - 3 >= 0) {
        $three = coinChange($coins, $money - 3);
    }
    if ($money - 5 >= 0) {
        $five = coinChange($coins, $money - 5);
    }
    return 1 + min($one, $three, $five);
}