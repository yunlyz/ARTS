<?php

/*
 * @lc app=leetcode id=108 lang=php
 *
 * [108] Convert Sorted Array to Binary Search Tree
 */

/**
 * Definition for a binary tree node.
 * class TreeNode {
 *     public $val = null;
 *     public $left = null;
 *     public $right = null;
 *     function __construct($value) { $this->val = $value; }
 * }
 */
class TreeNode
{
    public $val = null;
    /**
     * @var TreeNode|null
     */
    public $left = null;
    /**
     * @var TreeNode|null
     */
    public $right = null;

    function __construct($value)
    {
        $this->val = $value;
    }
}

class Solution
{

    /**
     * @param Integer[] $nums
     *
     * @return TreeNode
     */
    function sortedArrayToBST($nums)
    {
        $root = null;
        $middle = intval(count($nums) / 2);
        $cnt = count($nums);
        if ($cnt == 1) {
            $root = new TreeNode($nums[$middle]);
        } elseif ($cnt == 0) {
        } else {
            $root = new TreeNode($nums[$middle]);
            $root->left = $this->sortedArrayToBST(array_slice($nums, 0, $middle));
            $root->right = $this->sortedArrayToBST(array_slice($nums, $middle + 1));
        }

        return $root;
    }
}

