<?php

/**
 * 医生的所有预约单
 */
require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Appointment.php";
$uid =@$_GET["uid"];
$tid =@$_GET["tid"];
try{
    if(is_null($uid)){
        echo Response::json(-3,"无效参数");
    }else{
        $conn = MySQLConnector::connect();
        $sql ="";
        if(!is_null($tid))
            $sql = "select * from rsl.appointment inner JOIN rsl.user on  rsl.appointment.patient ='".$uid."' and rsl.appointment.doctor='".$tid."' and rsl.appointment.patient=rsl.user.id;";
        else
            $sql = "select * from rsl.appointment inner JOIN rsl.user on  rsl.appointment.patient ='".$uid."'  and rsl.appointment.doctor=rsl.user.id;";
        $res = $conn->query($sql);
        $data = array();
        if(@$res->num_rows>0){
            while($row = $res->fetch_row()){
                array_push($data,new Appointment($row));
            }
        }
        $conn->close();
        if(count($data)<=0){
            echo Response::json(-1,"无数据");
        }else{
            echo Response::json(0,$data);
        }
    }
}catch (Exception $e) {
    echo Response::json(-100, $e->getMessage());
}