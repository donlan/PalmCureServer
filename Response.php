<?php

/**
 * 返回数据的统一模板类
 */
class Response
{
    /**
     * @param $code 返回的状态码
     * @param $msg 返回的具体信息，会解析成json字符串
     * @return string json的字符串结果
     * @throws Exception
     */
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