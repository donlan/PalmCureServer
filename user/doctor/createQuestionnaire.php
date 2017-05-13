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
$doctor = @$_POST["doctor"];
$patient = @$_POST["patient"];
$question = @$_POST["questions"];
$intro = @$_POST["intro"];
$level = @$_POST["level"];
try {

    if (!is_null($doctor) || !is_null($patient)) {

        $questionObj = json_decode($question);
        $id = sha1(time().$doctor.$patient);
        var_dump($questionObj);
        if (is_array($questionObj)) {

            $conn = MySQLConnector::connect();

            $sql = "INSERT INTO rsl.questionnaire(id,doctor,patient,intro,status,level) VALUES (?,?,?,?,?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssii",$id, $doctor, $patient, $intro,Config::STATUS_QN_NEW(),$level);
            $stmt->execute();


            $count = count($questionObj);
            $sql = "INSERT INTO rsl.record(id,questionnaire,question) VALUES (?,?,?)";
            $stmt = $conn->prepare($sql);

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
