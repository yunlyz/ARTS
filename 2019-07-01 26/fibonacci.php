<?php
/**
 * User: Yun Lv(yunlv.go@gmail.com)
 * Date: 2019-07-01 09:51
 */

function fibonacci($n)
{
    if ($n < 2) {
        return $n;
    } else {
        return fibonacci($n - 1) + fibonacci($n - 2);
    }
}