<?php
require_once __DIR__ . '/configs/Sessions.php';
Sessions::start();
require_once __DIR__ . '/vendor/Facebook/autoload.php';

$fb = new Facebook\Facebook([
    'app_id' => '594861107374131',
    'app_secret' => '75ddda60a2df1ee363244e994891e773',
    'default_graph_version' => 'v2.8',
]);

$helper = $fb->getRedirectLoginHelper();

try {
    $accessToken = $helper->getAccessToken();
} catch(Facebook\Exceptions\FacebookResponseException $e) {
    // When Graph returns an error
    echo 'Graph returned an error: ' . $e->getMessage();
    exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
    // When validation fails or other local issues
    echo 'Facebook SDK returned an error: ' . $e->getMessage();
    exit;
}

if (! isset($accessToken)) {
    if ($helper->getError()) {
        header('HTTP/1.0 401 Unauthorized');
        echo "Error: " . $helper->getError() . "\n";
        echo "Error Code: " . $helper->getErrorCode() . "\n";
        echo "Error Reason: " . $helper->getErrorReason() . "\n";
        echo "Error Description: " . $helper->getErrorDescription() . "\n";
    } else {
        header('HTTP/1.0 400 Bad Request');
        echo 'Bad request';
    }
    exit;
}

if (isset($accessToken)) {
    // Logged in!
    // Now you can redirect to another page and use the
    // access token from $_SESSION['facebook_access_token']
    // But we shall we the same page
    // Sets the default fallback access token so
    // we don't have to pass it to each request
    $fb->setDefaultAccessToken($accessToken);
    try {
        $response = $fb->get('/me?fields=email,name,picture');
        $userNode = $response->getGraphUser();
    }catch(Facebook\Exceptions\FacebookResponseException $e) {
        // When Graph returns an error
        echo 'Graph returned an error: ' . $e->getMessage();
        exit;
    } catch(Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        echo 'Facebook SDK returned an error: ' . $e->getMessage();
        exit;
    }
    // Print the user Details
//    echo "Welcome !<br><br>";
//    echo 'Name: ' . $userNode->getName().'<br>';
//    echo 'User ID: ' . $userNode->getId().'<br>';
//    echo 'Email: ' . $userNode->getEmail().'<br><br>';
//    $image = 'https://graph.facebook.com/'.$userNode->getId().'/picture?width=200';
//    echo "Picture<br>";
//    echo "<img src='$image' /><br><br>";

   Sessions::set('id', $userNode->getName());
   Sessions::set('picture', $userNode->getPicture()['url']);
   Sessions::set('email', $userNode->getEmail());

    header('Location: /messages');

}else{
    $permissions  = ['email'];
    $loginUrl = $helper->getLoginUrl($redirect,$permissions);
    echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
}
// User is logged in with a long-lived access token.
// You can redirect them to a members-only page.
//header('Location: https://example.com/members.php');