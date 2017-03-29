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

            $sql = "SELECT * FROM comments WHERE mid = $mid AND parent_id = mid";
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
    $child_id = $_POST['child_id'];

$commentMailTitle = "New comment was added!";

    $id_session =  Sessions::get('id');
    $email_session = Sessions::get('email');

    $sql = "INSERT INTO comments (mid, parent_id, child_id , cdesc,cdate,author) VALUES ('$mid','$parent_id', '$child_id', '$cdesc' ,'$cdate','$author')";
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

public static function getChildsComments ($child) {
    $conn = Db::connect();

    Sessions::start();

    if($child !== 0) {
        $child_id = $child;
//        var_dump($allChilds);

        $sql = "SELECT c1.*, COUNT( c2.parent_id ) AS childcount FROM comments c1
            LEFT JOIN comments c2 ON c2.parent_id = c1.cid
            WHERE c1.child_id = '$child_id'
            GROUP BY c1.cid";
        $result = $conn->query($sql);

        $count = $result->num_rows;

        return $count;

    } else {
        return 0;
    }

//    $allChilds = self::getAllComments();
//
//    foreach ($allChilds as $child) {
//        $child_id = $child['child_id'];



    }

//    $child_id = '16';

//}


}