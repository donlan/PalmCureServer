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
$id = @$_GET['id'];
try {
    if (!is_null($id)) {
        $conn = MySQLConnector::connect();
        $sql = "SELECT * FROM rsl.record INNER JOIN rsl.question ON  rsl.record.questionnaire ='" . $id . "' AND rsl.record.question = rsl.question.id order by rsl.record.createdAt;";
        $res = $conn->query($sql);
        $data = array();
        if (@$res->num_rows > 0) {
            while ($row = $res->fetch_row()){
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
    } else {
        if (is_null($doctor) || is_null($patient)) {
            echo Response::json(-3, "无效参数");
        } else {
            $conn = MySQLConnector::connect();
            $sql = "SELECT * FROM rsl.questionnaire  WHERE  rsl.questionnaire.patient ='" . $patient . "'  AND rsl.questionnaire.doctor='" . $doctor . "' ORDER BY updatedAt DESC";
            $res = $conn->query($sql);
            $data = array();
            if (@$res->num_rows > 0) {
                while ($row = $res->fetch_row()) {
                    array_push($data, new Questionnaire($row, false));
                }
            }
            $conn->close();
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