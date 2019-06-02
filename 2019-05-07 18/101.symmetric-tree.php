<?php

/*
 * @lc app=leetcode id=101 lang=php
 *
 * [101] Symmetric Tree
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
     * @return Boolean
     */
    function isSymmetric($root)
    {
        return $this->compare($root, $root);
    }

    /**
     * @param TreeNode $l
     * @param TreeNode $r
     *
     * @return Boolean
     */
    function compare($l, $r): bool
    {
        if ($l->val === null && $r->val === null) {
            return true;
        }
        if ($l->val != $r->val) {
            return false;
        }
        return ($l->val == $r->val) &&
            $this->compare($l->right, $r->left) &&
            $this->compare($l->left, $r->right);
    }
}

