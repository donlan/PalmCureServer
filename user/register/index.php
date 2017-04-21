<?php
/**
 */

$username = @$_POST["username"];
$passwd = @$_POST["passwd"];
$type = @$_POST["type"];

require_once "../../MySQLConnector.php";

if(is_null($username) || is_null($passwd) || is_null($type)){
    echo Response::json(-102,"参数为空");
    return;
}

$conn =  MySQLConnector::connect();
$id = sha1(time().$username);
try {
    $stmt = $conn->prepare("insert into  rsl.user (id,username,password,type) VALUES (?,?,?,?)");
    $stmt->bind_param("sssi",$id,$username, $passwd, $type);
    $stmt->execute();
    $conn->close();
    $stmt->close();
}catch (Exception $e){
    echo Response::json(-101,$e);
}
echo Response::json(0,$id);

