<?php
/**
 * 医生的所有患者
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Contract.php";

//医生的id
$uid =@$_GET["uid"];

try{
    if(is_null($uid)){
        echo Response::json(-3,"无效参数");
    }else{
        $conn = MySQLConnector::connect();
        //从contact表中查询doctor id == uid的结果，同时连表查询出患者的信息（inner join 内联查询）
        $sql = "select * from rsl.contract inner JOIN rsl.user on  rsl.contract.doctor ='".$uid."'  and rsl.contract.patient=rsl.user.id;";
        $res = $conn->query($sql);
        $data = array(); //返回结果的数组
        if(@$res->num_rows>0){//查询结果不为空
            while($row = $res->fetch_row()){ //循环获取每一行的结果
                array_push($data,new Contract($row)); //将结果用Contract封装，压入数组
            }
        }
        $conn->close();
        if(count($data)<=0){ //数据为空，那么就是没有绑定的患者
            echo Response::json(-1,"无数据");
        }else{
            echo Response::json(0,$data); //反回的数组就是所有绑定的患者信息
        }
    }
}catch (Exception $e){
    echo Response::json(-100,$e->getMessage());
}