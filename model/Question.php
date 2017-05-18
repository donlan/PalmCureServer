<?php

/**
 * 定义的一个问题
 */
class Question
{
    var $id;      //问题的唯一id
    var $type;    //问题类型
    var $qdescribe; //问题描述
    var $qkey;    //问题的答案的json字符串
    var $options;   //问题的选项的json字符串
    var $answer;   //用户填写的答案
    var $creator;  //问题的创建者
    var $score;  //得分
    var $createdAt; //创建时间

    /**
     * Question constructor.
     * @param $row 构造函数：根据MySql查询结果，传入一行查询结果
     * @param $i 是否是连表查询，是的话，一行的结果包含另一个表的一行数据，指明开始的索引
     */
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