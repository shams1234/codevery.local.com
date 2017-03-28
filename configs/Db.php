<?php

class Db
{

    public static function connect()
    {

        $host = 'localhost';
        $db = 'codevery_app';
        $user = 'shs';
        $pass = 'root';

        $conn = new mysqli( $host, $user, $pass, $db );

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;

    }

}