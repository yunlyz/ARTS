<?php

/*
 * @lc app=leetcode id=300 lang=php
 *
 * [300] Longest Increasing Subsequence
 */

class Solution
{

    /**
     * @param Integer[] $nums
     *
     * @return Integer
     */
    function lengthOfLIS1($nums)
    {
        $states = [];

        $states[0][] = [];
        $states[0][] = [$nums[0]];

        for ($i = 1; $i < count($nums); $i++) {
            $states[$i] = [];
            foreach ($states[$i - 1] as $state) {
                $states[$i][] = $state;  // 不加入
                if (end($state) <= $nums[$i]) {  // 加入
                    array_push($state, $nums[$i]);
                    $states[$i][] = $state;
                }
            }
        }

        $max = 0;
        foreach ($states[count($nums) - 1] as $state) {
            $max = max($max, count($state));
        }

        return $max;
    }

    /**
     * @param Integer[] $nums
     *
     * @return Integer
     */
    function lengthOfLIS($nums)
    {
        $states = [];
        if (!$nums) {
            return 0;
        }
        $max = $states[0] = 1;
        for ($i = 1; $i < count($nums); $i++) {
            $states[$i] = 1;
            for ($j = 0; $j < $i; $j++) {
                if ($nums[$i] > $nums[$j]) {
                    $states[$i] = max($states[$i], $states[$j] + 1);
                }
            }

            $max = max($states[$i], $max);
        }

        return $max;
    }
}

