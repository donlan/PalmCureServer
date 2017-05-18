<?php
/**
 * 患者绑定医生
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
$doctorId = @$_GET["doctorId"];
$patientId = @$_GET["patientId"];
$status = @$_GET["status"];
$id = @$_GET["id"]; //contract 表的id
//参数判空
if (is_null($doctorId) || is_null($patientId)) {
    echo Response::json(-1, "参数无效");
} else {
    try {
        $conn = MySQLConnector::connect();
        if (is_null($id)) { //绑定id 为空，则是新建绑定
            $status = 0;
            $id = sha1( $doctorId . $patientId);
            //使用预编译sql语句的形式插入数据，防止sql注入
            $stmt = $conn->prepare("INSERT INTO  rsl.contract (id,doctor,patient,status) VALUES (?,?,?,?)");
            //绑定插入的数据
            $stmt->bind_param("sssi", $id, $doctorId, $patientId, $status);
            $stmt->execute();
            $stmt->close();
            echo Response::json(0, $id);
        } else { //id不为空就是更新绑定状态，1：医生同意，2：医生拒绝
            if (!is_numeric($status) ||( $status != 0 && $status != 1)) {
                echo Response::json(-3, "无效绑定参数");
            } else {

                if($conn->query("UPDATE rsl.contract SET status=" . $status . " WHERE id ='" . $id . "';")){
                    echo Response::json(0,"更新成功");
                }else{
                    echo Response::json(-4,"更新状态失败");
                }
            }
            $conn->close();
        }
    } catch (Exception $e) {
        echo Response::json(-101, $e);
    }

}