<?php

/*
 * @lc app=leetcode id=83 lang=php
 *
 * [83] Remove Duplicates from Sorted List
 */

/**
 * Definition for a singly-linked list.
 * class ListNode {
 *     public $val = 0;
 *     public $next = null;
 *     function __construct($val) { $this->val = $val; }
 * }
 */
class ListNode
{
    public $val = 0;
    /**
     * @var ListNode
     */
    public $next = null;

    function __construct($val)
    {
        $this->val = $val;
    }
}

class Solution
{
    // 链表有序，只需要比较当前元素与下一个元素的值
    // 如果相等，则删除下一个元素，并且把下一个元素的指正指向下下一个元素
    // 如果不相等，把当前指正指向下一个元素
    /**
     * @param ListNode $head
     *
     * @return ListNode
     */
    function deleteDuplicates($head)
    {
        $current = $head;
        while ($current != null && $current->next != null) {
            if ($current->val == $current->next->val) {
                $current->next = $current->next->next;
            } else {
                $current = $current->next;
            }
        }

        return $head;
    }
}

