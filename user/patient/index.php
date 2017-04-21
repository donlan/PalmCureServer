<?php
/**
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/User.php";

$uid =@$_GET["uid"];

try{
    $conn = MySQLConnector::connect();
    if(is_null($uid)){
        $sql = "select * from rsl.user where type = 2";
    }else{
        $sql = "select * from rsl.user where type = 2 and id ='".$uid."';";
    }
    $res = $conn->query($sql);
    $data = array();
    if(@$res->num_rows>0){
        while($row = $res->fetch_row()){
            array_push($data,new User($row,false));
        }
    }
    echo Response::json(0,$data);
}catch (Exception $e){
    echo Response::json(-100,$e->getMessage());
}