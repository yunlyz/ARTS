<?php
/**
 * User: Yun Lv(yunlv.go@gmail.com)
 * Date: 2019-07-01 16:20
 */


/**
 * Class Solution
 * 冒泡排序重复遍历需要排序的数组，一次比较两个元素，如果他们的顺序错误就把他们交换过来，直到没有数据需要交换，表明数组已经排序完成。
 *
 * 1.比较相邻元素，如果顺序错误交换他们的值
 * 2.对每对相邻的元素做相同的工作，从开始的一对到结尾的最后一对。这一步做完，最后的元素会是最大或者最小的值
 * 3.针对所有元素重复以上步骤，除了最后一个
 * 4.持续每次对越来越少的元素重复上面的步骤，直到没有任何一个数字需要比较
 */
class Solution
{

    /**
     * @param Integer[] $nums
     *
     * @return Integer[]
     */
    function sortArray($nums)
    {
        $end = count($nums) - 1;
        while ($end > 0) {
            $pos = 0;
            for ($i = 0; $i < $end; $i++) {
                if ($nums[$i] > $nums[$i + 1]) {
                    $this->swap($nums[$i], $nums[$i + 1]);
                    $pos = $i + 1;
                }
            }
            $end = $pos;
        }
        return $nums;
    }

    function swap(&$a, &$b)
    {
        $a = $a ^ $b;
        $b = $a ^ $b;
        $a = $a ^ $b;
    }
}

