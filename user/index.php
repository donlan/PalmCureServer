<?php
/**
 */

$uid = @$_GET["uid"];

require_once "../MySQLConnector.php";
$conn =  MySQLConnector::connect();
$sql = "select * from rsl.user WHERE id='".$uid."'";
$res = $conn->query($sql);
if(@$res->num_rows >0){
    $row = $res->fetch_row();
    $row["password"] ="";
    echo Response::json(0,$row);
}else{
    echo Response::json(-100,"无此用户");
}
$conn->close();

