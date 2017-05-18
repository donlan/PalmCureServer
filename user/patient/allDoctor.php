<?php
/**
 * 查询系统中所有的医生信息
 */

require_once "../../MySQLConnector.php";
require_once "../../Response.php";
require_once "../../model/User.php";
try {
    $conn = MySQLConnector::connect();
    // type = 1的user就是医生
    $res = $conn->query("SELECT * FROM rsl.user WHERE type=1");
    if ($res->num_rows > 0) {
        $data = array();
        while ($row = $res->fetch_row()) { //处理查询的结果的每一行
            array_push($data, new User($row, false));
        }
        if(count($data)<=0){
            echo Response::json(-1,"无数据");
        }else{
            echo Response::json(0,$data); //返回所有医生信息
        }
    } else {
        echo Response::json(-1, "无数据");
    }
} catch (Exception $exception) {
    echo Response::json(-100, $exception->getMessage());
}