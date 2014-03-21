<?php
/**
 * String functions
 */

class CString
{
    static function truncate($string, $limit, $break = " ", $pad = "...")
    {
        // return with no change if string is shorter than $limit
        if (mb_strlen($string, 'UTF-8') <= $limit) {
            return $string;
        }
        $string = mb_substr($string, 0, $limit, 'UTF-8');
        if (false !== ($breakpoint = mb_strrpos($string, $break, null, 'UTF-8'))) {
            $string = mb_substr($string, 0, $breakpoint, 'UTF-8');
        }
        return $string . $pad;
    }

}