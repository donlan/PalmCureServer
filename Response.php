<?php

/**
 */
class Response
{
    public static function json($code, $msg)
    {
        if(!is_numeric($code))
            throw new Exception("error code");
        $res = array(
            'code' => $code,
            'data' => json_encode($msg,JSON_UNESCAPED_UNICODE)
        );
        return json_encode($res,JSON_UNESCAPED_UNICODE);
    }

}