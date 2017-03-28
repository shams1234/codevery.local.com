<?php

class Router
{

    public function go() {

        $route = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

        $routes = [
            '/' => ['controller' => 'main', 'action' => 'index'],
            '/index.php' => ['controller' => 'main', 'action' => 'index'],
            '/users' => ['controller' => 'users', 'action' => 'showAllUsers'],

            '/comments' => ['controller' => 'comments', 'action' => 'showAllComments'],

            '/getComments' => ['controller' => 'comments', 'action' => 'showCommentsByMessageID'],

            '/messages' => ['controller' => 'messages', 'action' => 'showAllMessages'],

            '/login' => ['controller' => 'users', 'action' => 'Login'],
            '/anonymous' => ['controller' => 'users', 'action' => 'Login'],
            '/setMessages' => ['controller' => 'messages', 'action' => 'setMessages'],
            '/setComments' => ['controller' => 'comments', 'action' => 'setComments'],
            '/logout' => ['controller' => 'users', 'action' => 'userLogout'],
            '/loadMore' => ['controller' => 'messages', 'action' => 'messagesLoadMore'],

        ];

        if (isset($routes[$route])) {

           $controllerName = $routes[$route]['controller'] . 'Controller';
           $controllerFile = 'controllers/' . $routes[$route]['controller'] . 'Controller' . '.php';

           $controllerAction = $routes[$route]['action'];

            if (file_exists($controllerFile)){

                require_once $controllerFile;
                $controllerNew = new $controllerName;
                $controllerNew -> $controllerAction();

            }else {
                echo 'No file found: ' . $controllerFile;
            }
        } else {
            require_once(ROOT . '/views/404.php');
            return true;
        }
        return false;
    }

}

