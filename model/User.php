<?php

/**
 * 用户模板类
 */
class User
{
    var $id;
    var $username;
    var $password;
    var $nickname;
    var $phone;
    var $sex;
    var $type;
    var $verify;
    var $updatedAt;


    public function __construct($row,$i)
    {
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