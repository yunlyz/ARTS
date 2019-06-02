<?php
/*
 * @lc app=leetcode id=110 lang=php
 *
 * [110] Balanced Binary Tree
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
class Solution
{

    /**
     * @param TreeNode $root
     *
     * @return Boolean
     */
    function isBalanced($root)
    {
        if ($root == null) return true;
        return $this->height($root) !== -1;
    }

    function height($root)
    {
        if (!$root) return 0;
        $left = $this->height($root->left);
        $right = $this->height($root->right);
        if ($left == -1 || $right == -1 || abs($left - $right) > 1) {
            return -1;
        }

        return max($left, $right) + 1;
    }
}

