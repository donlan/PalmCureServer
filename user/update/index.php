<?php
/**
 */

$user = @$_POST["user"];

require_once "../../MySQLConnector.php";

if(is_null($user)){
    echo Response::json(-102,"参数为空");
    return;
}

try {
    $userObj = json_decode($user);
    $conn =  MySQLConnector::connect();
    $sql = "update rsl.user set nickname='".$userObj['nickname']."' phone='".$userObj["phone"]."' ";
    $sql = $sql."where id='".$userObj['id']."'";
    $conn->close();
}catch (Exception $e){
    echo Response::json(-101,$e);
}
echo Response::json(0,"更新用户信息成功");

