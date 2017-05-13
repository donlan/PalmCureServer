<?php
/**
 */

$user = @$_POST["user"];

require_once "../../MySQLConnector.php";
require_once "../../Response.php";

if(is_null($user)){
    echo Response::json(-102,"参数为空");
    return;
}
try {
    $userObj = json_decode($user);
    if(is_object($userObj)) {
        $conn = MySQLConnector::connect();
        $sql = "UPDATE rsl.user SET nickname='" . $userObj->nickname . "' , phone='" . $userObj->phone . "', sex=" . $userObj->sex;
        $sql = $sql . " where id='" . $userObj->id . "'";
        $conn->query($sql);
        $conn->close();
        echo Response::json(0,"更新用户信息成功");
    }else{
        echo Response::json(-1,"参数异常");
    }
}catch (Exception $e){
    echo Response::json(-101,$e);
}

