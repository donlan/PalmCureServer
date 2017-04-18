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
            'data' => json_encode($msg)
        );
        return json_encode($res);
    }
}