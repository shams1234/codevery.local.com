<?php

require_once ROOT . '/configs/Mailer.php';

class Comments
{
    public static function getAllComments() {

        $conn = Db::connect();
        Sessions::start();

        $sql = "SELECT * FROM comments";
        $result = $conn->query($sql);
        $count = $result->num_rows;

        $allComments = [];

        if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $allComments[] = $row;
            }

        }

        return $allComments;

    }


    public static function getCommentsByMessageId() {

        $conn = Db::connect();
        Sessions::start();

        if (isset($_POST)) {

            $mid = ($_POST['id']) ;
        }
        else {
            echo 'nothing found';
        }

            $sql = "SELECT * FROM comments WHERE mid = $mid";
            $result = $conn->query($sql);

            $count = $result->num_rows;

            $commentsById = [];

            if ($count > 0) {
                while ($row = $result->fetch_assoc()) {
                    $commentsById[] = $row;
                }

            }


        return $commentsById;

}

public static function addComments () {

    $conn = Db::connect();

    Sessions::start();

    $cdesc = $_POST['comment'];
    $cdate = date("Y-m-d H:i:s");
    $author = Sessions::get('id');
    $mid = $_POST['mid'];
    $parent_id = $_POST['parent_id'];

$commentMailTitle = "New comment was added!";

    $id_session =  Sessions::get('id');
    $email_session = Sessions::get('email');

    $sql = "INSERT INTO comments (mid, parent_id, cdesc,cdate,author) VALUES ('$mid','$parent_id', '$cdesc' ,'$cdate','$author')";
    $result = $conn->query($sql);

    $data=[];
    if ($result === true) {

        $data = array(

            "cdesc" => $cdesc,
            "cdate" => $cdate,
            "author" => $author,

        );

        Mailer::commentMail($author, $commentMailTitle, $cdesc, $cdate);

    }

    return $data;

}

//public static function replyComments () {
//    $conn = Db::connect();
//
//    Sessions::start();
//
//    $cdesc = $_POST['reply'];
//    $cdate = date("Y-m-d H:i:s");
//    $author = Sessions::get('id');
//    $mid = $_POST['mid'];
//    $parent_id = $_POST['parent_id'];
//    $sql = "INSERT INTO comments (mid, parent_id, cdesc,cdate,author) VALUES ('$mid','$parent_id', '$cdesc' ,'$cdate','$author')";
//    $result = $conn->query($sql);
//    $commentMailTitle = "New comment was added!";
//
//    $data=[];
//    if ($result === true) {
//
//        $data = array(
//
//            "cdesc" => $cdesc,
//            "cdate" => $cdate,
//            "author" => $author,
//
//        );
//
//        Mailer::commentMail($author, $commentMailTitle, $cdesc, $cdate);
//
//    }
//
//    return $data;
//}

}