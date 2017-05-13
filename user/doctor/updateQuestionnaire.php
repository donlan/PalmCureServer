<?php 
require_once "../../Response.php";
require_once "../../MySQLConnector.php";
require_once "../../model/Question.php";
$questionnaire = @$_POST["questionnaire"];
$questions =@$_POST["questions"];

try{
	$qn = json_decode($questionnaire);
	if(is_object($qn)){
		$qs = json_decode($questions);
		$conn =  $conn = MySQLConnector::connect();
		if(is_array($qs)){
			foreach ($qs as $key => $value) {
				$q = $value;
				$sql ="update rsl.record set answer='".$q->answer."' where id='".$q->id."';";
				$conn->query($sql);
			}
            $sql ="update rsl.questionnaire set status=2 where id='".$qn->id."';";
            $conn->query($sql);
		}else{
			$sql ="update rsl.questionnaire set status=1,result='".$qn->result."' where id='".$qn->id."';";
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