<?php
/**
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/User.php";
require_once "VerifyTools.php";


$uid = @$_POST["uid"];
$idcard = @$_POST["idcard"];
try {
    $conn = MySQLConnector::connect();
    if (is_null($uid)) {
        echo Response::json(-1, "无效参数");
    } else {
        if (VerifyTools::verifyIdCard($idcard)) {
            $sql = "UPDATE  rsl.user SET verify = 1 WHERE id ='" . $uid . "';";
            if ($conn->query($sql)) {
                echo Response::json(0, "验证成功");
            } else {
                echo Response::json(-3, "无此医生信息");
            }
        } else {
            echo Response::json(-2, "无效身份证号");
        }
    }
} catch (Exception $e) {
    echo Response::json(-100, $e->getMessage());
}