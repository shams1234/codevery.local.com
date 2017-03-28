<?php


class Users
{

  public static function getAllUsers() {

      $conn = Db::connect();

    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    $count = $result->num_rows;

    if ($count > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }

  }

  public static function isLogin() {

      $conn = Db::connect();

      if (isset($_POST['email']) && $_POST['pwd']) {

          $useremail = $_POST['email'];
          $userpass = $_POST['pwd'];

          $sql = "SELECT * FROM users WHERE useremail = '$useremail' AND userpass = '$userpass'";
          $result = $conn->query($sql);
          $count = $result->num_rows;

          if ($count > 0) {
              if ( $row = $result->fetch_assoc()) {

                  Sessions::start();
//                    var_dump($_SESSION['id'] = $row['useremail']);
                  Sessions::set('id',$row['useremail']);
                  Sessions::set('email',$row['useremail']);
                  header("Location: /messages");

                  exit();
              }
          }else {
              header("Location: /");
              exit();
          }
      }
      return true;
  }



}