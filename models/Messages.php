<?php

require_once ROOT . '/configs/Mailer.php';

class Messages
{

    public static function getAllMessages()
    {

        Sessions::start();
//        public
//        function getAllMessages($from, $to)
//        {


            if (isset($_GET['offset']) && isset($_GET['limit'])) {

                $offset = $_GET['offset'];

                $limit = $_GET['limit'];


            } else {

                $limit = 5;
                $offset = 0;

            }
        $sql = "SELECT * FROM messages ORDER BY MID ASC LIMIT $limit OFFSET $offset";

//        $sql = "SELECT * FROM messages";
        $conn = Db::connect();

//        $sql = "SELECT * FROM messages ORDER BY MID DESC LIMIT $limit OFFSET $offset";
            $result = $conn->query($sql);
            $count = $result->num_rows;
            $data = [];
            if ($count > 0) {

                while ($row = $result->fetch_assoc()) {
                    $data[] = $row;
                }
                Sessions::set('messages', count($data));

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
        if ($result === true) {

            $last_id = $conn->insert_id;
            $data = array(
                "mtitle" => $mtitle,
                "mdesc" => $mdesc,
                "mpic" => $mpic,
                "mdate" => $mdate,
                "mauthor" => $mauthor,
                "mid" => $last_id
            );

            Mailer::messageMail($email_session, $mtitle, $mdesc, $mdate);

        }

        return $data;


    }

    public static function countMessages()
    {

//        Sessions::show();

        if (Sessions::get('messages')) {

            $count = Sessions::get('messages');


            return $count;
        } else {
            return 0;
        }
    }

}
