<?php

/**
 * 数据库连接模板类
 */

require_once "Response.php";
class MySQLConnector
{

    //通过静态方法获取一个数据库连接
    public static function connect()
    {

        /**
         * 参数分别是:数据库URL，用户名，密码，连接的数据库名
         */
        $conn = new mysqli("127.0.0.1", "root", "","rsl");
        if ($conn->connect_error) {
            die(Response::json(-1,"数据库连接失败"));
        }
        return $conn;
    }
}