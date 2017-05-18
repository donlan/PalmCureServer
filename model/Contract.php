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
     * @param $row 构造函数：根据MySql查询结果，传入一行查询结果
     * @internal param $id
     * @internal param $doctor 医生id
     * @internal param $patient 患者id
     * @internal param $status 状态码
     * @internal param $createdAt 创建时间
     * @internal param $updatedAt 更新时间
     * @internal param $user 请求绑定的用户信息
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
