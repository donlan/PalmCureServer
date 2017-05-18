<?php

/**
 *医生身份证认证的工具类
 */
class VerifyTools
{
    public static function verifyIdCard($idcard){
        //这里只是简单的判断是不是17位的身份证长度
        if(is_null($idcard) || strlen($idcard)!=17){
            return false;
        }
        return true;
    }
}