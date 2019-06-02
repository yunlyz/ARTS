<?php

/*
 * @lc app=leetcode id=69 lang=php
 *
 * [69] Sqrt(x)
 */

class Solution
{
    // 运用二分查找方法，查找范围0-x内的符合条件的值
    /**
     * @param Integer $x
     *
     * @return Integer
     */
    function mySqrt($x)
    {
        $left = 0;
        $right = $x;

        while ($left < $right) {
            $middle = ceil($left + ($right - $left) / 2);
            if (pow($middle, 2) == $x) {
                return $middle;
            }
            if (pow($middle, 2) > $x) {
                $right = $middle - 1;
            } else {
                $left = $middle;
            }
        }

        return $left;
    }
}

