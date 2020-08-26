<?php
namespace app\helpers;

class TokenHelper
{
    /**
     * @return string
     */
    public static function generateString()
    {
        return rand(1000, 9999) . time();
    }
}