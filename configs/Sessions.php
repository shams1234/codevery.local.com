<?php

class Sessions
{
    private static $sessionStarted = false;

    public static function start(){

        if (self::$sessionStarted == false) {
            session_start();
            self::$sessionStarted = true;
        }

    }

    public static function set ($key, $value) {
        $_SESSION[$key] = $value;
    }

    public static function get ($key) {
        if(isset($_SESSION[$key])){
            return $_SESSION[$key];
        } else return false;
    }

    public static function show(){

        echo "<pre>";
            print_r ($_SESSION);
        echo "</pre>";
    }

    public static function unsetSession($key) {

        unset($_SESSION[$key]);
    }

    public static function destroy(){
        if (self::$sessionStarted === true ){
            session_unset();
            session_destroy();
        }
    }
}