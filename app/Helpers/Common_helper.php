<?php
if (!function_exists('formatId')) {
    /**
     * format ID
     *
     * @param <type> $number
     * @param <type> $prefix The Prefix
     * @param <type> $digit
     */
    function formatId($number, $prefix='SRN',  $digit=8)
    {
       return $prefix . sprintf('"%0{$digit}d', $number);
    }
}
?>