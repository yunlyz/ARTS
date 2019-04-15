class Solution
{
    // 算法思路：预先把罗马字符串分割成字符数组，从右往左顺序循环读取，终止条件为数组大小为 0
    // 1. 若当前指向的罗马字符小于或者等于下一个罗马字符，则相加
    // 2. 若当前指向的罗马字符大于下一个罗马字符，则相减
    // 3. 在开始时，last为空，表示开始，直接与total相加
    /**
     * @param String $s
     *
     * @return Integer
     */
    function romanToInt($s)
    {
        $map = [
            'I' => 1,
            'V' => 5,
            'X' => 10,
            'L' => 50,
            'C' => 100,
            'D' => 500,
            'M' => 1000,
        ];
        $total = 0;
        $str = str_split($s);
        $last = "";
        while (count($str) > 0) {
            $current = array_pop($str);
            if ($last != '' && $map[$current] < $map[$last]) {
                $total -= $map[$current];
            } else {
                $total += $map[$current];
            }
            $last = $current;
        }
        return $total;
    }
}