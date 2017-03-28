<?php

require_once ROOT . '/configs/Mailer.php';

class Messages
{

    public static function getAllMessages() {
//    public function getAllMessages($from, $to) {

//
//        if (isset($_GET['offset']) && isset($_GET['limit'])) {
//
//            $offset = $_GET['offset'];
//
//            $limit = $_GET['limit'];
//
//            $sql = "SELECT * FROM messages ORDER BY MID DESC LIMIT $limit OFFSET $offset";
//
//        } else {
//
//            $limit = 1;
//            $offset = 0;
//            $sql = "SELECT * FROM messages ORDER BY MID DESC LIMIT $limit OFFSET $offset";
//        }

        $sql = "SELECT * FROM messages";
        $conn = Db::connect();

//        $sql = "SELECT * FROM messages ORDER BY MID DESC LIMIT $limit OFFSET $offset";
        $result = $conn->query($sql);
        $count = $result->num_rows;
        $data = [];
        if ($count > 0) {
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }


        }

        return $data;
}

    public static function addMessages()
    {

        $conn = Db::connect();

        Sessions::start();

        $mtitle = $_POST['title'];
        $mdesc = $_POST['message'];
        $mdate = date("Y-m-d H:i:s");
        $mauthor = Sessions::get('id');


        $id_session =  Sessions::get('id');
        $email_session = Sessions::get('email');

        if ($id_session && $id_session == 'Anonymous' || $id_session == $email_session) {
            $mpic = 'https://randomuser.me/api/portraits/men/'. rand(1,99) . '.jpg';
        } else {
            $mpic = Sessions::get('picture');
        }


        $sql = "INSERT INTO messages (mtitle,mdesc,mpic,mdate,mauthor) VALUES ('$mtitle','$mdesc','$mpic','$mdate','$mauthor')";
        $result = $conn->query($sql);

        $data=[];
        if ($result === TRUE) {

            $last_id = $conn->insert_id;
            $data = array(
                "mtitle" => $mtitle,
                "mdesc" => $mdesc,
                "mpic" => $mpic,
                "mdate" => $mdate,
                "mauthor" => $mauthor,
                "mid" => $last_id
            );

            Mailer::messageMail($mauthor, $mtitle, $mdesc, $mdate);

        }

        return $data;



//        if ($result === TRUE) {
//            echo "New record created successfully";
//        } else {
//            echo "Error: " . $sql . "<br>" . $this->connect()->errno;
//        }

    }

}
