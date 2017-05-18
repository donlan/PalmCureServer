<?php
/**
 * 登录请求处理
 */

header("Content-type: text/html; charset=utf-8");

//获取请求参数
$username = @$_POST["username"]; //用户名
$passwd = @$_POST["passwd"]; //密码
$type = @$_POST["type"]; //类型

require_once "../../MySQLConnector.php";
require_once "../../Response.php";
require_once "../../model/User.php";

$conn =  MySQLConnector::connect();
//根据上面的三个参数，查询数据库
$sql = "select * from rsl.user WHERE username='".$username."' and password='".$passwd."' and type=".$type;
$res = $conn->query($sql);
if(@$res->num_rows >0){//如果找到唯一匹配，那么说明用户名密码匹配，登录成功
    $row = $res->fetch_row();
    $row["password"] ="";
    $conn->close();
    echo Response::json(0,new User($row,false)); //返回用户信息
}else{
    echo Response::json(-100,"无此用户");
}
