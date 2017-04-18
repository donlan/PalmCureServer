<?php
/**
 */

$username = @$_POST["username"];
$passwd = @$_POST["passwd"];
$type = @$_POST["type"];

require_once "../../MySQLConnector.php";
$conn =  MySQLConnector::connect();
$sql = "select * from rsl.user WHERE username='".$username."' and password='".$passwd."' and type=".$type;
$res = $conn->query($sql);
if(@$res->num_rows >0){
    $row = $res->fetch_row();
    $row["password"] ="";
    echo Response::json(0,$row);
}else{
    echo Response::json(-100,"无此用户");
}
$conn->close();
