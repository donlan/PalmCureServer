<?php

/**
 * Created by PhpStorm.
 * User: doogo
 * Date: 2017/5/11
 * Time: 17:24
 */
class Questionnaire
{

    var $id;
    var $doctor;
    var $patient;
    var $intro;
    var $status;
    var $level;
    var $result;
    var $createdAt;
    var $updatedAt;
    var $user;

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