<?php

/**
 * 用户模板类
 */
class User
{
    var $id;   //唯一id
    var $username; //用户名
    var $password; //密码
    var $nickname; //昵称
    var $phone; //手机号码
    var $sex; //性别
    var $type; //用户类型  医生或者患者
    var $verify; //是否是认证用户
    var $updatedAt; //更新时间


    public function __construct($row,$i)
    {
        //可能是连表查询，那么用户信息的开始索引不唯一，由外部传入
        if(is_int($i)){
            $this->id = $row[$i++];
            $this->username = $row[$i++];
            $this->password = "";
            $i++;
            $this->nickname = $row[$i++];
            $this->phone = $row[$i++];
            $this->sex = $row[$i++];
            $this->type = $row[$i++];
            $this->verify = $row[$i++];
            $this->updatedAt = $row[$i++];
        }else {
            $this->id = $row[0];
            $this->username = $row[1];
            $this->password = "";
            $this->nickname = $row[3];
            $this->phone = $row[4];
            $this->sex = $row[5];
            $this->type = $row[6];
            $this->verify = $row[7];
            $this->updatedAt = $row[8];
        }
    }



}