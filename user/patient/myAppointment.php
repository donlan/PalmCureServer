<?php

/**
 * 返回患者所有预约
 */
require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Appointment.php";
$uid =@$_GET["uid"];//患者id
$tid =@$_GET["tid"];//医生id
try{
    if(is_null($uid)){//患者id不能为空
        echo Response::json(-3,"无效参数");
    }else{
        $conn = MySQLConnector::connect();
        $sql ="";
        if($tid != ""){// 医生id与患者id都不为空，则查询的是指定该患者与指定的医生的预约记录
            $sql = "SELECT * FROM rsl.appointment INNER JOIN rsl.user ON  rsl.appointment.patient ='".$uid."' and rsl.appointment.doctor='".$tid."' and rsl.appointment.doctor=rsl.user.id;";
        }
        else{//查询的是指定该患者的所有医生的预约记录
            $sql = "SELECT * FROM rsl.appointment INNER JOIN rsl.user on  rsl.appointment.patient ='".$uid."'  and rsl.appointment.doctor=rsl.user.id;";
        }
        $res = $conn->query($sql);
        $data = array();
        if(@$res->num_rows>0){//能查询到结果
            while($row = $res->fetch_row()){
                //new Appointment($row) 就是将一行信息封装到一个实体类中去，这样方便通过json进行格式化，还有解析
                array_push($data,new Appointment($row));//封装数据，并压入待返回给客户端的数组
            }
        }

        $conn->close();
        if(count($data)<=0){//查询结果为空
            echo Response::json(-1,"无数据");
        }else{
            echo Response::json(0,$data);
        }
    }
}catch (Exception $e) {
    echo Response::json(-100, $e->getMessage());
}