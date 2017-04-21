<?php
/**
 * 预约
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";

$doctorId = @$_POST["doctorId"];
$patientId =@$_POST["patient"];
$id = @$_POST["id"];
$status =@$_POST["status"];
$reason = @$_POST["reason"];
$booktime = @$_POST["booktime"];

if(is_null($id)){
    if(is_null($patientId) || is_null($doctorId) || !is_numeric($status) ||is_null($reason) || is_null($booktime)){
        echo Response::json(-1,"非法参数");
    }else{
        try{
            $conn = MySQLConnector::connect();
            $status = 0;
            $id = sha1( time().$doctorId . $patientId);
            $stmt = $conn->prepare("INSERT INTO  rsl.appointment (id,doctor,patient,reason,status,booktime) VALUES (?,?,?,?,?,?)");
            $stmt->bind_param("ssssis", $id, $doctorId, $patientId, $reason,$status,$booktime);
            $stmt->execute();
            $stmt->close();
            $conn->close();
            echo Response::json(0, $id);
        }catch (Exception $exception){
            echo Response::json(-103,$exception->getMessage());
        }
    }
}else{
    $conn = MySQLConnector::connect();
    if (!is_numeric($status) ||( $status != 0 && $status != 1)) {
        echo Response::json(-3, "无效参数");
    } else {
        if($conn->query("UPDATE rsl.appointment SET status=" . $status . " WHERE id ='" . $id . "';")){
            echo Response::json(0,"更新成功");
        }else{
            echo Response::json(-4,"更新状态失败");
        }
    }
    $conn->close();
}