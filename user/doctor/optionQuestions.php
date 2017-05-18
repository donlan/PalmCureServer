<?php
/**
 * 返回一个医生创建的所有问题
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Question.php";
require_once "../../model/Config.php";
$uid = @$_GET["uid"]; //医生id
try{
    $conn = MySQLConnector::connect();
    //creator = uid 就是创建者等于指定医生id的记录 ，type = 0是系统默认，也就是我们预先创建好的，不是医生手动创建的
    $sql ="select * from rsl.question WHERE creator='".$uid."' or type = 0;";
    $res = $conn->query($sql);
    if($res->num_rows >0){ //能查询到结果
        $data = array();
        while ($row = $res->fetch_row()){ //将查询结果封装到数组中
            array_push($data,new Question($row,""));
        }
        echo Response::json(0,$data); //返回结果
    }else{
        echo Response::json(-1,"无数据");
    }
    $conn->close();
}catch (Exception $exception){
    echo Response::json(-100,$exception->getMessage());
}
