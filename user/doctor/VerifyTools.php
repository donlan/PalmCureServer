<?php

/**
 * Created by PhpStorm.
 * User: doogo
 * Date: 2017/4/19
 * Time: 12:06
 */
class VerifyTools
{
    public static function verifyIdCard($idcard){
        if(is_null($idcard) || strlen($idcard)!=17){
            return false;
        }
        return true;
    }
}