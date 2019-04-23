<?php

/*
 * @lc app=leetcode id=9 lang=php
 *
 * [9] Palindrome Number
 *
 * https://leetcode.com/problems/palindrome-number/description/
 *
 * algorithms
 * Easy (42.64%)
 * Total Accepted:    546K
 * Total Submissions: 1.3M
 * Testcase Example:  '121'
 *
 * Determine whether an integer is a palindrome. An integer is a palindrome
 * when it reads the same backward as forward.
 * 
 * Example 1:
 * 
 * 
 * Input: 121
 * Output: true
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: -121
 * Output: false
 * Explanation: From left to right, it reads -121. From right to left, it
 * becomes 121-. Therefore it is not a palindrome.
 * 
 * 
 * Example 3:
 * 
 * 
 * Input: 10
 * Output: false
 * Explanation: Reads 01 from right to left. Therefore it is not a
 * palindrome.
 * 
 * 
 * Follow up:
 * 
 * Coud you solve it without converting the integer to a string?
 * 
 */

class Solution
{
    // 判断一个数字是否为回文数，方法有两种：
    // 1. 通过反转数字，比较反转之后的数字是否与之前相等
    // 2. 和数字当前字符串，反转字符串，比较两个字符串是否相等
    // 特殊说明：负数一定不是回文数，如果参数为负数，直接返回，提高效率。
    /**
     * @param Integer $x
     *
     * @return Boolean
     */
    function isPalindrome($x)
    {
        $result = false;
        $palindRome = 0;
        $src = $x;
        if ($x < 0) {
            return $result;
        }
        while ($x != 0) {
            $palindRome = $palindRome * 10 + $x % 10;
            $x = (int)($x / 10);
        }

        if ($palindRome == $src) {
            $result = true;
        }
        return $result;
    }
}
