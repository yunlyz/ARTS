<?php

/*
 * @lc app=leetcode id=88 lang=php
 *
 * [88] Merge Sorted Array
 */

class Solution
{
    // 解题思路：因为两个数组为有序数组，遍历两个数组，分别比较即可
    // 从数组num1倒序插入，这样可以保证num1中没有比较的元素不会被覆盖
    /**
     * @param Integer[] $nums1
     * @param Integer   $m
     * @param Integer[] $nums2
     * @param Integer   $n
     *
     * @return NULL
     */
    function merge(&$nums1, $m, $nums2, $n)
    {
        $index1 = $m - 1;
        $index2 = $n - 1;
        $cnt = $m + $n - 1;
        while ($index1 >= 0 || $index2 >= 0) {
            if ($index1 < 0) {
                $nums1[$cnt--] = $nums2[$index2--];
            } elseif ($index2 < 0) {
                $nums1[$cnt--] = $nums1[$index1--];
            } elseif ($nums1[$index1] < $nums2[$index2]) {
                $nums1[$cnt--] = $nums2[$index2--];
            } else {
                $nums1[$cnt--] = $nums1[$index1--];
            }
        }
        return null;
    }
}

