<?php
/**
 * String functions
 */

class CString
{
  static function truncate($string, $limit, $break = " ", $pad = "...")
  {
    // return with no change if string is shorter than $limit
    if (strlen($string) <= $limit) {
      return $string;
    }
    $string = substr($string, 0, $limit);
    if (false !== ($breakpoint = strrpos($string, $break))) {
      $string = substr($string, 0, $breakpoint);
    }
    return $string . $pad;
  }

}