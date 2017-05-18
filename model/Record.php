<?php

/**
 *一个问卷中，一个问题就对应的一个记录信息
 */
require_once "Question.php";

class Record
{
    var $id;   //唯一id
    var $questionnaire; //问卷id
    var $question; //问题id
    var $answer; //患者填写的答案
    var $score; //得分
    var $createdAt; //创建时间
    var $questionObj; //更新时间

    /**
     * Record constructor.
     * @param $row 查询得到的一行结果
     */
    public function __construct($row)
    {
        $this->id = $row[0];
        $this->questionnaire = $row[1];
        $this->question = $row[2];
        $this->answer = $row[3];
        $this->score = $row[4];
        $this->createdAt = $row[5];
        $this->questionObj = new Question($row, 6);
    }


}