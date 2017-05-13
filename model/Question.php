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

    public function __construct($row,$i)
    {
        if(is_numeric($i)){
            $this->id = $row[$i++];
            $this->type = $row[$i++];
            $this->qdescribe = $row[$i++];
            $this->qkey = json_decode($row[$i++]);
            $this->options = json_decode($row[$i++]);
            $this->answer = $row[$i++];
            $this->creator = $row[$i++];
            $this->score = $row[$i++];
            $this->createdAt = $row[$i++];
        }else{
            $this->id = $row[0];
            $this->type = $row[1];
            $this->qdescribe = $row[2];
            $this->qkey = json_decode($row[3]);
            $this->options = json_decode($row[4]);
            $this->answer = $row[5];
            $this->creator = $row[6];
            $this->score = $row[7];
            $this->createdAt = $row[8];
        }

    }


}