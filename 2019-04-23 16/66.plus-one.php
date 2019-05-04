<?php

/*
 * @lc app=leetcode id=66 lang=php
 *
 * [66] Plus One
 *
 * https://leetcode.com/problems/plus-one/description/
 *
 * algorithms
 * Easy (40.93%)
 * Total Accepted:    378K
 * Total Submissions: 921.4K
 * Testcase Example:  '[1,2,3]'
 *
 * Given a non-empty array of digits representing a non-negative integer, plus
 * one to the integer.
 * 
 * The digits are stored such that the most significant digit is at the head of
 * the list, and each element in the array contain a single digit.
 * 
 * You may assume the integer does not contain any leading zero, except the
 * number 0 itself.
 * 
 * Example 1:
 * 
 * 
 * Input: [1,2,3]
 * Output: [1,2,4]
 * Explanation: The array represents the integer 123.
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: [4,3,2,1]
 * Output: [4,3,2,2]
 * Explanation: The array represents the integer 4321.
 * 
 */

class Solution
{

    /**
     * @param Integer[] $digits
     *
     * @return Integer[]
     */
    function plusOne($digits)
    {

        $first = $digits[count($digits) - 1];
        $remainder = intval(($first + 1) / 10);
        $digits[count($digits) - 1] = ($first + 1) % 10;

        for ($i = count($digits) - 2; $i >= 0; $i--) {
            if ($remainder === 0) {
                break;
            }
            $current = $digits[$i];
            $digits[$i] = ($current + $remainder) % 10;
            $remainder = intval(($current + $remainder) / 10);
        }
        if ($remainder !== 0) {
            array_unshift($digits, $remainder);
        }

        return $digits;
    }
}

