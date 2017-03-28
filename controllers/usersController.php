<?php

require_once ROOT . '/models/Users.php';


class usersController
{
    public static function showAllUsers() {
        $datas = Users::getAllUsers();
        foreach ($datas as $data) {
            echo $data['username'] . "<br />";
            echo $data['useremail'] . "<br />";
        }
}

    public static function Login() {

       $isLogin = Users::isLogin();

        if (isset($_POST['anonymous']) && isset($_POST['license'])) {
            Sessions::start();
            Sessions::set('id', 'Anonymous');
            header("Location: /messages");
            exit();
        } else {
            Sessions::start();
            header("Location: /");
            exit();
        }

    }

    public static function userLogout () {
//        if (isset($_POST['logout'])) {
            Sessions::start();
            Sessions::destroy();

            header("Location: /");
            exit();
//        }
    }


}

