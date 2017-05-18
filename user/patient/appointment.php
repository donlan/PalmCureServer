<?php
/**
 * 患者的预约
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";

$doctorId = @$_POST["doctorId"];
$patientId =@$_POST["patient"];
$id = @$_POST["id"];
$status =@$_POST["status"];
$reason = @$_POST["reason"];
$booktime = @$_POST["booktime"];
$appointment = @$_POST["appointment"];

if(is_null($id)){ //没有预约id,那么就是创建一个新的预约
    //参数判空
    if(is_null($patientId) || is_null($doctorId) || !is_numeric($status) ||is_null($reason) || is_null($booktime)){
        echo Response::json(-1,"非法参数");
    }else{
        try{
            $conn = MySQLConnector::connect();
            $status = 0;
            $id = sha1( time().$doctorId . $patientId);//根据当前时间，医生id，患者id生成预约的唯一id
            //使用预编译sql语句的形式插入数据，防止sql注入
            $stmt = $conn->prepare("INSERT INTO  rsl.appointment (id,doctor,patient,reason,status,booktime) VALUES (?,?,?,?,?,?)");
            //绑定插入的数据
            $stmt->bind_param("ssssis", $id, $doctorId, $patientId, $reason,$status,$booktime);

            $stmt->execute();
            $stmt->close();
            $conn->close();
            echo Response::json(0, $id);
        }catch (Exception $exception){
            echo Response::json(-103,$exception->getMessage());
        }
    }
}else{ //id不能空，那就是对这个预约进行更新：包括预约状态，预约时间，
    $conn = MySQLConnector::connect();
    $appointment = json_decode($appointment);
    if (!is_object($appointment)) {
        echo Response::json(-3, "无效参数");
    } else {
        //使用sql update 语句更新appointment表
        $sql = "UPDATE rsl.appointment SET status=".$appointment->status.", booktime='".$appointment->booktime."' WHERE id ='".$id."';";
        if($conn->query($sql)){
            echo Response::json(0,"更新成功");
        }else{
            echo Response::json(-4,"更新状态失败");
        }
    }
    $conn->close();
}