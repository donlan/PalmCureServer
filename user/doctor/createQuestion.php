<?php
/**
 * 创建一个问题
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Question.php";
$uid = @$_POST["uid"];  //请求的id
$question =@$_POST["question"]; //客户端发送过来的问题Question实体类json字符串
try{
    $questionObj  = json_decode($question); //解析成Question实体类
    $id = sha1(time().$uid); //根据请求id和当前时间生成问题id
    $type = "1"; //问题类型
    $qdescribe = $questionObj->qdescribe; //问题描述
    $qkey = json_encode($questionObj->qkey); //问题选项的分值，基于key-value形式保存，所以要再一次json解析
    $options = json_encode($questionObj->options);//问题选项，基于key-value形式保存，所以要再一次json解析
    $score =$questionObj->score;//问题得分
    $conn = MySQLConnector::connect();
    //将问题插入数据库
    $sql ="insert into rsl.question(id,type,qdescribe,qkey,options,creator,score) VALUES (?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($sql);//使用预编译方式插入
    //绑定插入的参数，数据库自动根据绑定的参数进行插入
    $stmt->bind_param("ssssssi",$id,$type,$qdescribe,$qkey,$options,$uid,$score);

    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo Response::json(0,"创建成功");
}catch (Exception $exception){
    echo Response::json(-100,$exception->getMessage());
}
