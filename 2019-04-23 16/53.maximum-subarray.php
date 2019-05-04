<?php

/*
 * @lc app=leetcode id=53 lang=php
 *
 * [53] Maximum Subarray
 *
 * https://leetcode.com/problems/maximum-subarray/description/
 *
 * algorithms
 * Easy (43.18%)
 * Total Accepted:    506.4K
 * Total Submissions: 1.2M
 * Testcase Example:  '[-2,1,-3,4,-1,2,1,-5,4]'
 *
 * Given an integer array nums, find the contiguous subarray (containing at
 * least one number) which has the largest sum and return its sum.
 * 
 * Example:
 * 
 * 
 * Input: [-2,1,-3,4,-1,2,1,-5,4],
 * Output: 6
 * Explanation: [4,-1,2,1] has the largest sum = 6.
 * 
 * 
 * Follow up:
 * 
 * If you have figured out the O(n) solution, try coding another solution using
 * the divide and conquer approach, which is more subtle.
 * 
 */

class Solution
{

    /**
     * @param Integer[] $nums
     *
     * @return Integer
     */
    function maxSubArray($nums)
    {
        $result = $current = $nums[0];
        for ($i = 1; $i < count($nums); $i++) {
            $current = max($nums[$i], $current + $nums[$i]);
            $result = max($result, $current);
        }
        return $result;
    }
}

