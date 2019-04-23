<?php

/*
 * @lc app=leetcode id=20 lang=php
 *
 * [20] Valid Parentheses
 *
 * https://leetcode.com/problems/valid-parentheses/description/
 *
 * algorithms
 * Easy (36.19%)
 * Total Accepted:    559.5K
 * Total Submissions: 1.5M
 * Testcase Example:  '"()"'
 *
 * Given a string containing just the characters '(', ')', '{', '}', '[' and
 * ']', determine if the input string is valid.
 * 
 * An input string is valid if:
 * 
 * 
 * Open brackets must be closed by the same type of brackets.
 * Open brackets must be closed in the correct order.
 * 
 * 
 * Note that an empty string is also considered valid.
 * 
 * Example 1:
 * 
 * 
 * Input: "()"
 * Output: true
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: "()[]{}"
 * Output: true
 * 
 * 
 * Example 3:
 * 
 * 
 * Input: "(]"
 * Output: false
 * 
 * 
 * Example 4:
 * 
 * 
 * Input: "([)]"
 * Output: false
 * 
 * 
 * Example 5:
 * 
 * 
 * Input: "{[]}"
 * Output: true
 * 
 * 
 */

class Solution
{
    // 解题思路：将字符串分割成字符数组，从右到左遍历，利用栈先进后出特性，将开括号入栈，遇到闭括号则出栈，与之相比较。
    //         可以将字符转换成ASCII码比较。
    /**
     * @param String $s
     *
     * @return Boolean
     */
    function isValid($s)
    {
        $stack = [];

        $brackets = [
            '(' => ')',
            '[' => ']',
            '{' => '}',
        ];
        $openBrackets = array_keys($brackets);
        $closedBrackets = array_values($brackets);

        $arr = str_split($s, 1);
        while (count($arr) > 0) {
            $element = array_shift($arr);
            if (in_array($element, array_merge($openBrackets, $closedBrackets), true)) {
                if (in_array($element, $openBrackets, true)) {
                    array_push($stack, $element);
                } else {
                    $openBracket = array_pop($stack);
                    if ($brackets[$openBracket] != $element) {
                        return false;
                    }
                }
            }
        }
        if (count($stack) > 0) {
            return false;
        }

        return true;
    }
}
