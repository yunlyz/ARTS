<?php

/*
 * @lc app=leetcode id=7 lang=php
 *
 * [7] Reverse Integer
 *
 * https://leetcode.com/problems/reverse-integer/description/
 *
 * algorithms
 * Easy (25.23%)
 * Total Accepted:    651.5K
 * Total Submissions: 2.6M
 * Testcase Example:  '123'
 *
 * Given a 32-bit signed integer, reverse digits of an integer.
 * 
 * Example 1:
 * 
 * 
 * Input: 123
 * Output: 321
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: -123
 * Output: -321
 * 
 * 
 * Example 3:
 * 
 * 
 * Input: 120
 * Output: 21
 * 
 * 
 * Note:
 * Assume we are dealing with an environment which could only store integers
 * within the 32-bit signed integer range: [−2^31,  2^31 − 1]. For the purpose
 * of this problem, assume that your function returns 0 when the reversed
 * integer overflows.
 * 
 */

class Solution
{

    /**
     * @param Integer $x
     *
     * @return Integer
     */
    function reverse($x)
    {
        $default = $result = 0;
        while ($x != 0) {
            // 每次循环获取x的末位数，与result*10相加，得到当前逆转的数值
            $result = $result * 10 + $x % 10;
            $x = (int)($x / 10);
        }
        if ($result < pow(-2, 31) || $result > pow(2, 31) - 1) {
            return $default;
        }
        return $result;
    }
}
