<?php
/**
 * Created by PhpStorm.
 * User: doogo
 * Date: 2017/4/20
 * Time: 20:14
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Question.php";
require_once "../../model/Config.php";
$uid = @$_GET["uid"];
try{
    $conn = MySQLConnector::connect();
    $sql ="select * from rsl.question WHERE creator='".$uid."' or type = 0;";
    $res = $conn->query($sql);
    if($res->num_rows >0){
        $data = array();
        while ($row = $res->fetch_row()){
            array_push($data,new Question($row,""));
        }
        echo Response::json(0,$data);
    }else{
        echo Response::json(-1,"无数据");
    }
    $conn->close();
}catch (Exception $exception){
    echo Response::json(-100,$exception->getMessage());
}
