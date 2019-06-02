<?php

/*
 * @lc app=leetcode id=70 lang=php
 *
 * [70] Climbing Stairs
 */

class Solution
{
    // 动态规划算法，自下而上
    /**
     * @param Integer $n
     *
     * @return Integer
     */
    function climbStairs($n)
    {
        $first = 1;
        $second = 2;
        $total = 0;

        if ($n == 1) {
            return $first;
        }
        if ($n == 2) {
            return $second;
        }

        for ($i = 3; $i <= $n; $i++) {
            $total = $first + $second;
            $first = $second;
            $second = $total;
        }

        return $total;
    }
}

