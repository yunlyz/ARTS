<?php

/*
 * @lc app=leetcode id=67 lang=php
 *
 * [67] Add Binary
 *
 * https://leetcode.com/problems/add-binary/description/
 *
 * algorithms
 * Easy (38.49%)
 * Total Accepted:    293.4K
 * Total Submissions: 758.1K
 * Testcase Example:  '"11"\n"1"'
 *
 * Given two binary strings, return their sum (also a binary string).
 * 
 * The input strings are both non-empty and contains only characters 1 or 0.
 * 
 * Example 1:
 * 
 * 
 * Input: a = "11", b = "1"
 * Output: "100"
 * 
 * Example 2:
 * 
 * 
 * Input: a = "1010", b = "1011"
 * Output: "10101"
 * 
 */

class Solution
{

    /**
     * @param String $a
     * @param String $b
     *
     * @return String
     */
    function addBinary($a, $b)
    {
        $arrA = str_split($a);
        $arrB = str_split($b);

        $length = max(count($arrA), count($arrB));
        if (count($arrA) > count($arrB)) {
            $arrB = array_pad($arrB, -$length, 0);
        } else {
            $arrA = array_pad($arrA, -$length, 0);
        }

        $remainder = 0;
        for ($i = $length - 1; $i >= 0; $i--) {
            $current = $arrA[$i] + $arrB[$i] + $remainder;
            $arrB[$i] = $current % 2;
            $remainder = intval($current / 2);
        }
        if ($remainder !== 0) {
            array_unshift($arrB, $remainder);
        }

        return implode('', $arrB);
    }
}

