<?php
/**
 */
//请求参数user为用户的实体信息，实际是User类的json字符串
$user = @$_POST["user"];

require_once "../../MySQLConnector.php";
require_once "../../Response.php";

//参数判空
if(is_null($user)){
    echo Response::json(-102,"参数为空");
    return;
}
try {
    $userObj = json_decode($user); //根据json字符串解析成对象
    if(is_object($userObj)) { //解析正常
        $conn = MySQLConnector::connect();
        //更新用户信息，根据唯一id
        $sql = "UPDATE rsl.user SET nickname='" . $userObj->nickname . "' , phone='" . $userObj->phone . "', sex=" . $userObj->sex;
        $sql = $sql . " where id='" . $userObj->id . "'";
        $conn->query($sql);
        $conn->close();
        echo Response::json(0,"更新用户信息成功");
    }else{
        echo Response::json(-1,"参数异常");
    }
}catch (Exception $e){ //出现异常则，更新失败
    echo Response::json(-101,$e);
}

