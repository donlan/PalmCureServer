<?php
/**
 */

header("Content-type: text/html; charset=utf-8");
$username = @$_POST["username"];
$passwd = @$_POST["passwd"];
$type = @$_POST["type"];

require_once "../../MySQLConnector.php";
require_once "../../Response.php";
require_once "../../model/User.php";

$conn =  MySQLConnector::connect();
$sql = "select * from rsl.user WHERE username='".$username."' and password='".$passwd."' and type=".$type;
$res = $conn->query($sql);
if(@$res->num_rows >0){
    $row = $res->fetch_row();
    $row["password"] ="";
    $conn->close();
    echo Response::json(0,new User($row,false));
}else{
    echo Response::json(-100,"无此用户");
}
