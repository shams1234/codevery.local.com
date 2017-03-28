<?php

require_once __DIR__ . '/vendor/google/apiclient/src/Google/autoload.php';

const REDIRECT = 'http://codevery.local.com/g-callback.php';

require_once __DIR__ . '/configs/Sessions.php';

Sessions::start();

$client = new Google_Client();
$client->setClientId('962086650062-urc5etpqcv0d38v3lo9euhesqtqoockk.apps.googleusercontent.com');
$client->setClientSecret('T3zFNzvzjO_QKhnt7lrbSqPz');
$client->setRedirectUri(REDIRECT);
$client->addScope("https://www.googleapis.com/auth/plus.login email");
$plus = new Google_Service_Plus($client);

if (isset($_REQUEST['/logout'])) {

    Sessions::unsetSession('access_token');
}

if (isset($_GET['code'])) {
    if (strval($_SESSION['state']) !== strval($_GET['state'])) {
        error_log('The session state did not match.');
        exit(1);
    }

    $client->authenticate($_GET['code']);
//    $_SESSION['access_token'] = $client->getAccessToken();

    Sessions::set('access_token',$client->getAccessToken());

    header('Location: ' . REDIRECT);
}

if (Sessions::get('access_token')) {
    $client->setAccessToken(Sessions::get('access_token'));
}

if ($client->getAccessToken()) {
    try {
        $me = $plus->people->get('me');
        $jsonData = '<pre>' . print_r($me, TRUE) . '</pre>';

        Sessions::set('picture',$me->getImage()['url']);
        Sessions::set('id',$me->getDisplayName());
        Sessions::set('email',$me->getEmails()[0]['value']);


        header('Location: /messages');
    } catch (Google_Exception $e) {
        error_log($e);
        $jsonData = htmlspecialchars($e->getMessage());
    }
    # the access token may have been updated lazily

    Sessions::set('access_token',$client->getAccessToken());
//    $_SESSION['id'] = $person
} else {
    $state = mt_rand();
    $client->setState($state);

    Sessions::set('state',$state) ;
    $googleLoginBtn = sprintf('<p><a class="button" href="%s">Google +</a></p>',
        $client->createAuthUrl());
}

?>
