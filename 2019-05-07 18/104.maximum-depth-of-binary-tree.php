<?php

/*
 * @lc app=leetcode id=104 lang=php
 *
 * [104] Maximum Depth of Binary Tree
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
     * @param TreeNode $root
     *
     * @return Integer
     */
    function maxDepth($root)
    {
        if ($root->val === null) {
            return 0;
        }
        return 1 + max($this->maxDepth($root->left), $this->maxDepth($root->right));
    }
}

