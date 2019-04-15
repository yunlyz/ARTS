class Solution
{

    /**
     * @param String[] $strs
     *
     * @return String
     */
    function longestCommonPrefix($strs)
    {
        $prefix = '';
        if (count($strs) < 1) {
            return $prefix;
        }
        $prefix = $strs[0];
        while (strlen($prefix) > 0) {
            $isEqual = false;
            foreach ($strs as $str) {
                $isEqual = substr($str, 0, strlen($prefix)) === $prefix ? true : false;
                if (!$isEqual) {
                    break;
                }
            }
            if ($isEqual) {
                return $prefix;
            } else {
                $prefix = substr($prefix, 0, strlen($prefix)-1);
            }
        }
        return $prefix;
    }
}
