<?php

class mainController
{
    public function index()

    {

        Sessions::start();

        require_once ROOT . '/g-callback.php';
        require_once ROOT . '/configs/Sessions.php';

        $fb = new \Facebook\Facebook([
            'app_id' => '594861107374131',
            'app_secret' => '75ddda60a2df1ee363244e994891e773',
            'default_graph_version' => 'v2.8',
        ]);

        $helper = $fb->getRedirectLoginHelper();

        $permissions = ['email']; // Optional permissions

        $loginUrl = $helper->getLoginUrl('http://codevery.local.com/fb-callback.php', $permissions);

       require_once(ROOT . '/views/index.php');

        return true;
    }
}