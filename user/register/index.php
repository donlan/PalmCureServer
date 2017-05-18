<?php
/**
 * 注册请求处理
 */

$username = @$_POST["username"]; //注册的用户名
$passwd = @$_POST["passwd"]; //注册密码
$type = @$_POST["type"]; //注册类型

require_once "../../MySQLConnector.php";

//参数判断
if(is_null($username) || is_null($passwd) || is_null($type)){
    echo Response::json(-102,"参数为空");
    return;
}

$conn =  MySQLConnector::connect();
$id = sha1(time().$username); //根据用户名与当前时间生成id
try {
    //插入数据库
    $stmt = $conn->prepare("insert into  rsl.user (id,username,password,type) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi",$id,$username, $passwd, $type);
    $stmt->execute();
    $conn->close();
    $stmt->close();
}catch (Exception $e){ //出现异常，无法完成注册
    echo Response::json(-101,$e);
}
//注册成功，则返回注册成功的id
echo Response::json(0,$id);

