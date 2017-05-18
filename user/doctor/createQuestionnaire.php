<?php
/**
 * 创建一个问卷
 */

require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Question.php";
require_once "../../model/Config.php";
$doctor = @$_POST["doctor"]; //医生id
$patient = @$_POST["patient"];//患者id
$question = @$_POST["questions"]; //问题的id数组
$intro = @$_POST["intro"]; //问卷介绍
$level = @$_POST["level"]; //问卷的评分等级
try {

    //医生与患者id都不能为空
    if (!is_null($doctor) || !is_null($patient)) {

        $questionObj = json_decode($question); //解析出问题的id数组
        $id = sha1(time().$doctor.$patient); //根据医生id患者id当前时间生成唯一id
        if (is_array($questionObj)) {//解析的问题id数组无误

            $conn = MySQLConnector::connect();

            //先将问卷信息插入问卷表
            $sql = "INSERT INTO rsl.questionnaire(id,doctor,patient,intro,status,level) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssii",$id, $doctor, $patient, $intro,Config::STATUS_QN_NEW(),$level);
            $stmt->execute();



            $count = count($questionObj);
            //根据id,问卷id,问题id插入
            $sql = "INSERT INTO rsl.record(id,questionnaire,question) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);
            //遍历问题id表，根据每个问题id插入到问题记录表
            for ($i = 0; $i < $count; $i++) {
                var_dump($questionObj[$i]);
                $rid = sha1(time() . $id);
                $stmt->bind_param("sss",$rid, $id, $questionObj[$i]);
                $stmt->execute();
            }
            $stmt->close();
            $conn->close();
            echo Response::json(0, "创建成功");
        } else {
            echo Response::json(-1, "非法参数");
        }
    } else {
        echo Response::json(-1, "非法参数");
    }
} catch (Exception $exception) {
    echo Response::json(-100, $exception->getMessage());
}
