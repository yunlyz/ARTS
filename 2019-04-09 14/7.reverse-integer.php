class Solution
{

    /**
     * @param Integer $x
     *
     * @return Integer
     */
    function reverse($x)
    {
        $default = $result = 0;
        while ($x != 0) {
            // 每次循环获取x的末位数，与result*10相加，得到当前逆转的数值
            $result = $result * 10 + $x % 10;
            $x = (int)($x / 10);
        }
        if ($result < pow(-2, 31) || $result > pow(2, 31) - 1) {
            return $default;
        }
        return $result;
    }
}
