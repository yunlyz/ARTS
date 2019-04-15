/* {{{ proto string strrev(string str)
   Reverse a string */
#if ZEND_INTRIN_SSSE3_NATIVE
#include <tmmintrin.h>
#endif
PHP_FUNCTION(strrev)
{
    // strrev参数str
    zend_string *str;
    // 分别表示开始字符和结束字符地址
    const char *s, *e;
    // 返回结果地址指针
    char *p;
    // 
    zend_string *n;

    // 解析函数参数并绑定到str
    ZEND_PARSE_PARAMETERS_START(1, 1)
        Z_PARAM_STR(str)
    ZEND_PARSE_PARAMETERS_END();

    // 申请长度为 ZSTR_LEN(str) 的内存，STR_LEN(str)或者字符串长度
    n = zend_string_alloc(ZSTR_LEN(str), 0);
    // 获取指向字符串首元素的指针
    p = ZSTR_VAL(n);
    
    // 获取str的首元素的指针
    s = ZSTR_VAL(str);
    // 字符串的末位字符地址
    e = s + ZSTR_LEN(str);
    --e;
#if ZEND_INTRIN_SSSE3_NATIVE
    if (e - s > 15) {
        const __m128i map = _mm_set_epi8(
                0, 1, 2, 3,
                4, 5, 6, 7,
                8, 9, 10, 11,
                12, 13, 14, 15);
        do {
            const __m128i str = _mm_loadu_si128((__m128i *)(e - 15));
            _mm_storeu_si128((__m128i *)p, _mm_shuffle_epi8(str, map));
            p += 16;
            e -= 16;
        } while (e - s > 15);
    }
#endif
    // 把str的尾字符与n的首字符交换，达到反转效果
    while (e >= s) {
        *p++ = *e--;
    }
    // 将指针赋值为空
    *p = '\0';

    // 返回结果n
    RETVAL_NEW_STR(n);
}
/* }}} */

/* {{{ proto array str_split(string str [, int split_length])
   Convert a string to an array. If split_length is specified, break the string down into chunks each split_length characters long. */
PHP_FUNCTION(str_split)
{
    zend_string *str;
    zend_long split_length = 1;
    const char *p;
    size_t n_reg_segments;

    ZEND_PARSE_PARAMETERS_START(1, 2)
    Z_PARAM_STR(str)
    Z_PARAM_OPTIONAL
    Z_PARAM_LONG(split_length)
    ZEND_PARSE_PARAMETERS_END();

    if (split_length <= 0)
    {
        php_error_docref(NULL, E_WARNING, "The length of each segment must be greater than zero");
        RETURN_FALSE;
    }

    if (0 == ZSTR_LEN(str) || (size_t)split_length >= ZSTR_LEN(str))
    {
        array_init_size(return_value, 1);
        add_next_index_stringl(return_value, ZSTR_VAL(str), ZSTR_LEN(str));
        return;
    }

    array_init_size(return_value, (uint32_t)(((ZSTR_LEN(str) - 1) / split_length) + 1));
    n_reg_segments = ZSTR_LEN(str) / split_length;
    p = ZSTR_VAL(str);

    while (n_reg_segments-- > 0)
    {
        add_next_index_stringl(return_value, p, split_length);
        p += split_length;
    }

    if (p != (ZSTR_VAL(str) + ZSTR_LEN(str)))
    {
        add_next_index_stringl(return_value, p, (ZSTR_VAL(str) + ZSTR_LEN(str) - p));
    }
}
/* }}} */