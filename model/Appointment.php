<?php

/**
 * 预约信息封装类
 */

require_once "User.php";
class Appointment
{

    var $id;
    var $doctor;   //医生id
    var $patient;  //患者id
    var $reason;   //预约请求理由
    var $status;    //状态
    var $booktime;  //预约时间
    var $createdAt; //创建时间
    var $updatedAt; //更新时间
    var $user;      //请求用户信息

    /**
     * 构造函数：根据MySql查询结果，传入一行查询结果
     */
    public function __construct($row)
    {
        $this->id = $row[0];
        $this->doctor = $row[1];
        $this->patient = $row[2];
        $this->reason = $row[3];
        $this->status = $row[4];
        $this->booktime = $row[5];
        $this->createdAt = $row[6];
        $this->updatedAt = $row[7];
        $this->user = new User($row,8);
    }


}