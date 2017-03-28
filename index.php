<?php

define ('ROOT', dirname(__FILE__));


require_once(ROOT . '/configs/Db.php');

require_once(ROOT . '/configs/Sessions.php');

require_once ROOT. '/vendor/Facebook/autoload.php';

require_once ROOT . '/vendor/google/apiclient/src/Google/autoload.php';

require_once(ROOT . '/configs/Router.php');

$router = new Router();

$router ->go();