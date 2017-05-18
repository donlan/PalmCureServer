<?php

/**
 * 定义的一个文件信息
 */
class Questionnaire
{

    var $id;     //唯一id
    var $doctor;    //医生id
    var $patient;   //患者id
    var $intro;    //问卷描述
    var $status; //问卷状态：新建，测试中，完毕
    var $level; //评分等级 0-10 （得分与总分的比值描述）
    var $result; //医生填写的回复结果
    var $createdAt;//创建时间
    var $updatedAt; //更新时间
    var $user; //问卷对应的用户信息，也就是那个患者需要做这个问卷

    /**
     * Questionnaire constructor.
     * @param $row 查询结果的一行
     * @param $needUser  是否是连表查询
     */
    public function __construct($row,$needUser)
    {
        $this->id = $row[0];
        $this->doctor = $row[1];
        $this->patient = $row[2];
        $this->intro = $row[3];
        $this->status = $row[4];
        $this->level = $row[5];
        $this->result = $row[6];
        $this->createdAt = $row[7];
        $this->updatedAt = $row[8];
        if($needUser){
            $this->user = new User($row,9);
        }
    }


}