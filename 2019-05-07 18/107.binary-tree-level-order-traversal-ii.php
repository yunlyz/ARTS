<?php

/*
 * @lc app=leetcode id=107 lang=php
 *
 * [107] Binary Tree Level Order Traversal II
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
     * @return Integer[][]
     */
    function levelOrderBottom($root)
    {
        $result = [];
        if ($root == null) {
            return $result;
        }
        $queue = [];


        $item = [];
        array_push($queue, $root);
        $currentLevelLast = $root;
        $nextLevelLast = null;
        while ($queue) {
            /** @var TreeNode $current */
            $current = array_shift($queue);
            print_r($current->val);
            array_push($item, $current->val);
            if ($current->left) {
                array_push($queue, $current->left);
                $nextLevelLast = $current->left;
            }
            if ($current->right) {
                array_push($queue, $current->right);
                $nextLevelLast = $current->right;
            }
            if ($current === $currentLevelLast) {
                array_unshift($result, $item);
                $item = [];
                $currentLevelLast = $nextLevelLast;
                $nextLevelLast = null;
            }
        }

        return $result;
    }
}

