<?php
/**
 * 更新问卷信息，包括医生回复问卷评价，患者答题
 */
require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Question.php";

$questionnaire = @$_POST["questionnaire"]; //问卷的实体信息，json格式
$questions =@$_POST["questions"]; //问卷的所有问题，json格式

try{
	$qn = json_decode($questionnaire); //将json格式的问卷实体信息字符串，解析成一个对象
	if(is_object($qn)){ //解析成功说明。包含问卷信息
		$qs = json_decode($questions); //将json格式的问题数组实体信息字符串，解析成一个数组
		$conn =  $conn = MySQLConnector::connect();
		if(is_array($qs)){ //包含问题列表数组
			foreach ($qs as $key => $value) {
				$q = $value;
				//则更像每一个的问卷的问题记录的 答案（患者回答的答案）
				$sql ="update rsl.record set answer='".$q->answer."' where id='".$q->id."';";
				$conn->query($sql);
			}
			//更新问卷的状态 2：问卷问答完毕
            $sql ="update rsl.questionnaire set status='".$qn->status."' where id='".$qn->id."';";
            $conn->query($sql);
		}else{
		    //不包含问题列表数组，那么只更新问卷的状态， 1：等待患者答题
			$sql ="update rsl.questionnaire set status='".$qn->status."',result='".$qn->result."' where id='".$qn->id."';";
			$conn->query($sql);
			
		}
		$conn->close();
		echo Response::json(0,"更新成功");
	}else{
		echo Response::json(-1,"数据异常");
	}
	

}catch (Exception $exception){
    echo Response::json(-100,$exception->getMessage());
}