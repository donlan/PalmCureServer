<?php

/**
 * 返回所有问卷
 */
require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Questionnaire.php";
require_once "../../model/Record.php";
$doctor = @$_GET["doctor"];
$patient = @$_GET["patient"];
$id = @$_GET['id']; //问卷id
try {
    if (!is_null($id)) {//问卷id不为空，则返回该id对应的问卷信息和问卷所绑定的问题信息

        $conn = MySQLConnector::connect();
        //使用内联查询 该问卷对应的问题
        $sql = "SELECT * FROM rsl.record INNER JOIN rsl.question ON  rsl.record.questionnaire ='" . $id . "' AND rsl.record.question = rsl.question.id order by rsl.record.createdAt;";
        $res = $conn->query($sql);
        $data = array();
        if (@$res->num_rows > 0) {
            while ($row = $res->fetch_row()){
                //封装每一个问卷问题记录
                array_push($data,new Record($row,4));
            }
            if(count($data)<=0){
                echo Response::json(-1, "无数据");
            }else{
                echo Response::json(0, $data);
            }
        } else {
            echo Response::json(-1, "无数据");
        }
    } else { //id为空，则要求医生id，患者id都不为空，此时返回的是指定医生和患者的问卷记录
        if (is_null($doctor) || is_null($patient)) {
            echo Response::json(-3, "无效参数");
        } else {
            $conn = MySQLConnector::connect();
            //从问卷表中找到同时跟医生id，患者id匹配的记录
            $sql = "SELECT * FROM rsl.questionnaire  WHERE  rsl.questionnaire.patient ='" . $patient . "'  AND rsl.questionnaire.doctor='" . $doctor . "' ORDER BY updatedAt DESC";
            $res = $conn->query($sql);
            $data = array();
            if (@$res->num_rows > 0) {
                while ($row = $res->fetch_row()) {
                    //封装每一个问卷记录
                    array_push($data, new Questionnaire($row, false));
                }
            }
            $conn->close();
            //返回结果
            if (count($data) <= 0) {
                echo Response::json(-1, "无数据");
            } else {
                echo Response::json(0, $data);
            }
        }
    }
} catch (Exception $e) {
    echo Response::json(-100, $e->getMessage());
}