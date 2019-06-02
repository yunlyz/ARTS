<?php

/*
 * @lc app=leetcode id=100 lang=php
 *
 * [100] Same Tree
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
     * @var TreeNode
     */
    public $left = null;
    /**
     * @var TreeNode
     */
    public $right = null;

    function __construct($value)
    {
        $this->val = $value;
    }
}

class Solution
{
    // 解题思路：用中序遍历分别得到数组p、q，最后比较两个数组是否相等
    // 中序遍历需要注意一点：当节点叶子节点时，直接返回节点值无须遍历左右节点。
    // 另一种截图思路：递归遍历，分别比较两棵树的左右节点是否相等
    /**
     * @param TreeNode $p
     * @param TreeNode $q
     *
     * @return Boolean
     */
    function isSameTree($p, $q)
    {
        return $this->inOrder($p) === $this->inOrder($q);
    }

    /**
     * @param TreeNode|null $treeNode
     *
     * @return array
     */
    function inOrder($treeNode)
    {
        if ($treeNode == null) {
            return [null];
        } else {
            if ($treeNode->left == null && $treeNode->right == null) {
                return [$treeNode->val];
            }
            $left = $this->inOrder($treeNode->left);
            $root = $treeNode->val;
            $right = $this->inOrder($treeNode->right);

            return array_merge($left, [$root], $right);
        }
    }
}
