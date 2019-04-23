<?php

/*
 * @lc app=leetcode id=14 lang=php
 *
 * [14] Longest Common Prefix
 *
 * https://leetcode.com/problems/longest-common-prefix/description/
 *
 * algorithms
 * Easy (33.22%)
 * Total Accepted:    436.8K
 * Total Submissions: 1.3M
 * Testcase Example:  '["flower","flow","flight"]'
 *
 * Write a function to find the longest common prefix string amongst an array
 * of strings.
 * 
 * If there is no common prefix, return an empty string "".
 * 
 * Example 1:
 * 
 * 
 * Input: ["flower","flow","flight"]
 * Output: "fl"
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: ["dog","racecar","car"]
 * Output: ""
 * Explanation: There is no common prefix among the input strings.
 * 
 * 
 * Note:
 * 
 * All given inputs are in lowercase letters a-z.
 * 
 */

class Solution
{
    // 解题思路：选去数组中的任意一个字符当做前缀字符串（默认选取第一个），终止条件为当前缀字符串的长度为零或者
    // 前缀与每一个字符的前缀相匹配时返回结果
    // 优化思路：二分查找、搜索树
    /**
     * @param String[] $strs
     *
     * @return String
     */
    function longestCommonPrefix($strs)
    {
        $prefix = '';
        if (count($strs) < 1) {
            return $prefix;
        }
        $prefix = $strs[0];
        while (strlen($prefix) > 0) {
            $isEqual = false;
            foreach ($strs as $str) {
                $isEqual = substr($str, 0, strlen($prefix)) === $prefix ? true : false;
                if (!$isEqual) {
                    break;
                }
            }
            if ($isEqual) {
                break;
            } else {
                $prefix = substr($prefix, 0, strlen($prefix) - 1);
            }
        }
        return $prefix;
    }
}
