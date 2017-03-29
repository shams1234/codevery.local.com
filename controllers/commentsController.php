<?php

require_once (ROOT . '/models/Comments.php');

class commentsController
{

    public static function showAllComments() {

        $allComments = Comments::getAllComments();

        require_once (ROOT . '/views/layouts/tmplComments.php');

        return $allComments;
    }

    public static function showCommentsByMessageID() {


        $commentsById = Comments::getCommentsByMessageId();

//        echo json_encode($commentsById);

        require_once (ROOT . '/views/layouts/tmplComments.php');

        return true;
    }

    public static function setComments() {

        $newComment = Comments::addComments();

        $allComments = Comments::getAllComments();

//        echo json_encode($newMessage);

//        require_once (ROOT . '/views/layouts/tmplComments.php');

        return true;
    }

}