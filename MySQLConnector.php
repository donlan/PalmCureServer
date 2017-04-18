<?php

/**
 */

require_once "Response.php";
class MySQLConnector
{

    public static function connect()
    {
        $conn = new mysqli("127.0.0.1", "root", "","rsl");
        if ($conn->connect_error) {
            die(Response::json(-1,"数据库连接失败"));
        }
        return $conn;
    }
}