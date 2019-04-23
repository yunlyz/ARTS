<?php

/*
 * @lc app=leetcode id=28 lang=php
 *
 * [28] Implement strStr()
 *
 * https://leetcode.com/problems/implement-strstr/description/
 *
 * algorithms
 * Easy (31.59%)
 * Total Accepted:    407.9K
 * Total Submissions: 1.3M
 * Testcase Example:  '"hello"\n"ll"'
 *
 * Implement strStr().
 * 
 * Return the index of the first occurrence of needle in haystack, or -1 if
 * needle is not part of haystack.
 * 
 * Example 1:
 * 
 * 
 * Input: haystack = "hello", needle = "ll"
 * Output: 2
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: haystack = "aaaaa", needle = "bba"
 * Output: -1
 * 
 * 
 * Clarification:
 * 
 * What should we return when needle is an empty string? This is a great
 * question to ask during an interview.
 * 
 * For the purpose of this problem, we will return 0 when needle is an empty
 * string. This is consistent to C's strstr() and Java's indexOf().
 * 
 */

class Solution
{
    // 算法思路：查找字符串所在的位置就是相当于字符串搜索算法，搜索算法有BF、RK、BM、KMP等单模式匹配以及
    // trie和AC自动机等多模式匹配算法
    /**
     * @param String $haystack
     * @param String $needle
     *
     * @return Integer
     */
    function strStr($haystack, $needle)
    {
        $needleLen = strlen($needle);
        $haystackLen = strlen($haystack);
        $index = -1;
        if ($haystackLen < $needleLen) {
            return $index;
        }
        if ($haystackLen == $needleLen) {
            return $haystack === $needle ? 0 : $index;
        }
        for ($i = 0; $i <= $haystackLen - $needleLen; $i++) {
            if (substr($haystack, $i, $needleLen) === $needle) {
                $index = $i;
                break;
            }
        }
        return $index;
    }
}

