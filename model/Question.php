<?php

/**
 * Created by PhpStorm.
 * User: doogo
 * Date: 2017/4/20
 * Time: 20:15
 */
class Question
{
    var $id;
    var $type;
    var $qdescribe;
    var $qkey;
    var $options;
    var $answer;
    var $creator;
    var $score;
    var $createdAt;

    public function __construct($row)
    {
        $this->id = $row[0];
        $this->type = $row[1];
        $this->qdescribe = $row[2];
        $this->qkey = $row[3];
        $this->options = $row[4];
        $this->answer = $row[5];
        $this->creator = $row[6];
        $this->score = $row[7];
        $this->createdAt = $row[8];
    }


}