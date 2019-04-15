class Solution
{

    /**
     * @param Integer[] $nums
     * @param Integer   $target
     *
     * @return Integer[]
     */
    function twoSum($nums, $target)
    {
        $map = [];
        foreach ($nums as $key => $value) {
            $remainder = $target - $value;
            if (array_key_exists($remainder, $map)) {
                return [$key, $map[$remainder]];
            }
            $map[$value] = $key;
        }
        return [];
    }
}