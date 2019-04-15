class Solution
{
    // 判断一个数字是否为回文数，方法有两种：
    // 1. 通过反转数字，比较反转之后的数字是否与之前相等
    // 2. 和数字当前字符串，反转字符串，比较两个字符串是否相等
    // 特殊说明：负数一定不是回文数，如果参数为负数，直接返回，提高效率。
    /**
     * @param Integer $x
     *
     * @return Boolean
     */
    function isPalindrome($x)
    {
        $result = false;
        $palindRome = 0;
        $src = $x;
        if ($x < 0) {
            return $result;
        }
        while ($x != 0) {
            $palindRome = $palindRome * 10 + $x % 10;
            $x = (int)($x / 10);
        }

        if ($palindRome == $src) {
            $result = true;
        }

        return $result;
    }
}
