<?php

/**
 * Created by PhpStorm.
 * User: doogo
 * Date: 2017/4/19
 * Time: 16:11
 */
require_once "User.php";

class Contract
{
    var $id;
    var $doctor;
    var $patient;
    var $status;
    var $createdAt;
    var $updatedAt;
    var $user;

    /**
     * Contract constructor.
     * @param $row
     * @internal param $id
     * @internal param $doctor
     * @internal param $patient
     * @internal param $status
     * @internal param $createdAt
     * @internal param $updatedAt
     * @internal param $user
     */
    public function __construct($row)
    {
        $this->id = $row[0];
        $this->doctor = $row[1];
        $this->patient = $row[2];
        $this->status = $row[3];
        $this->createdAt = $row[4];
        $this->updatedAt = $row[5];
        $this->user = new User($row,6);
    }  //根据查询的不同，返回的是医生或者患者的数据


}
