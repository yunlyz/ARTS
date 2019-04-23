<?php

/*
* @lc app=leetcode id=1 lang=php
*
* [1] Two Sum
*
* https://leetcode.com/problems/two-sum/description/
*
* algorithms
* Easy (43.06%)
* Total Accepted: 1.7M
* Total Submissions: 3.8M
* Testcase Example: '[2,7,11,15]\n9'
*
* Given an array of integers, return indices of the two numbers such that they
* add up to a specific target.
*
* You may assume that each input would have exactly one solution, and you may
* not use the same element twice.
*
* Example:
*
*
* Given nums = [2, 7, 11, 15], target = 9,
*
* Because nums[0] + nums[1] = 2 + 7 = 9,
* return [0, 1].
*
*
*
*
*/

class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer   $target
     *
     * @return Integer[]
     */
    function twoSum($nums, $target)
    {
        $map = [];
        foreach ($nums as $key => $value) {
            $remainder = $target - $value;
            if (array_key_exists($remainder, $map)) {
                return [$key, $map[$remainder]];
            }
            $map[$value] = $key;
        }
        return [];
    }
}