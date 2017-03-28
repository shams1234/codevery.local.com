<?php

require_once (ROOT . '/models/Messages.php');
require_once (ROOT . '/models/Comments.php');


class messagesController
{

    public static function showAllMessages() {

    $allMessages = Messages::getAllMessages();

    $allComments = Comments::getAllComments();
    $commentsById = Comments::getCommentsByMessageId();

    $all =[];

    array_push($all,$allMessages);
//    array_push($all,$allComments);
    array_push($all,$commentsById);


    include (ROOT . '/views/messages.php');

    return $all;
}

    public static function messagesLoadMore() {

        if (isset($_POST['from'])) {

            $from = $_POST['from'];

            $allMessages = Messages::getAllMessages($from);

        }else{
            $allMessages = Messages::getAllMessages();
        }

//        echo json_encode($allMessages);

        include (ROOT . '/views/layouts/tmplMsg.php');

        return true;
    }


    public static function setMessages() {

        $newMessage = Messages::addMessages();

        $allMessages = Messages::getAllMessages();

//        echo json_encode($newMessage);

        include (ROOT . '/views/layouts/tmplMsg.php');

        return true;
    }

}