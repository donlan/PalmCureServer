<?php

/**
 * Created by PhpStorm.
 * User: doogo
 * Date: 2017/5/13
 * Time: 12:59
 */
require_once "Question.php";

class Record
{
    var $id;
    var $questionnaire;
    var $question;
    var $answer;
    var $score;
    var $createdAt;
    var $questionObj;

    /**
     * Record constructor.
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