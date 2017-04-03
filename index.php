<?php

define ('ROOT', dirname(__FILE__));

require_once(ROOT . '/vendor/PhpConsole/__autoload.php');

require_once(ROOT . '/configs/Db.php');

require_once(ROOT . '/configs/Sessions.php');

require_once ROOT. '/vendor/Facebook/autoload.php';

require_once ROOT . '/vendor/Google/autoload.php';

require_once(ROOT . '/configs/Router.php');

$router = new Router();

$PC = PhpConsole\Helper::register();

$router ->go();
