<?php

/*
 * @lc app=leetcode id=38 lang=php
 *
 * [38] Count and Say
 *
 * https://leetcode.com/problems/count-and-say/description/
 *
 * algorithms
 * Easy (39.97%)
 * Total Accepted:    274K
 * Total Submissions: 682.7K
 * Testcase Example:  '1'
 *
 * The count-and-say sequence is the sequence of integers with the first five
 * terms as following:
 * 
 * 
 * 1.     1
 * 2.     11
 * 3.     21
 * 4.     1211
 * 5.     111221
 * 
 * 
 * 1 is read off as "one 1" or 11.
 * 11 is read off as "two 1s" or 21.
 * 21 is read off as "one 2, then one 1" or 1211.
 * 
 * Given an integer n where 1 ≤ n ≤ 30, generate the n^th term of the
 * count-and-say sequence.
 * 
 * Note: Each term of the sequence of integers will be represented as a
 * string.
 * 
 * 
 * 
 * Example 1:
 * 
 * 
 * Input: 1
 * Output: "1"
 * 
 * 
 * Example 2:
 * 
 * 
 * Input: 4
 * Output: "1211"
 * 
 */

class Solution
{

    //
    /**
     * @param Integer $n
     *
     * @return String
     */
    function countAndSay($n)
    {
        $result = "1";
        $counter = 1;
        while ($counter < $n) {
            $result = $this->say($result);
            $counter++;
        }

        return $result;
    }

    function say($number): string
    {
        $say = "";
        $nums = strval($number);
        $cnt = 1;
        for ($i = 0; $i < strlen($nums); $i++) {
            if (isset($nums[$i + 1]) && $nums[$i] == $nums[$i + 1]) {
                $cnt++;
            } else {
                $say .= $cnt . $nums[$i];
                $cnt = 1;
            }
        }
        return $say;
    }
}

