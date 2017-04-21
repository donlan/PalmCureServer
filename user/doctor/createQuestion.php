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
$uid = @$_POST["uid"];
$question =@$_POST["question"];
try{
    $questionObj  = json_decode($question);
    $id = sha1(time().$uid);
    $type = 1;
    $qdescripe = $questionObj["qdescripe"];
    $qkey = $questionObj["qkey"];
    $options = $questionObj["options"];
    $score =$questionObj["score"];
    $conn = MySQLConnector::connect();
    $sql ="insert into rsl.question(id,type,qdescribe,qkey,options,creator,score) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param($id,$type,$qdescripe,$qkey,$options,$uid,$score);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo Response::json(0,"创建成功");
}catch (Exception $exception){
    echo Response::json(-100,$exception->getMessage());
}
