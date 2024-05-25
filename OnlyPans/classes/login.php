<?php

include_once("connect.php");

class Login {

    function evaluate($data) {
        $email = addslashes($data['email']);
        $password = addslashes($data['password']);

        $query = "SELECT * FROM users WHERE email = '$email' LIMIT 1";
        $Db = new Database();
        $res = $Db->read($query);

        if ($res) {
            $row = $res[0];

            if ($password == $row['password']) { 
                $_SESSION['only_pans_userid'] = $row['userid'];
                return true;
            } else {
                return "Wrong password!";
            }
        } else {
            return "Incorrect email!";
        }
    }

    function check_login($id) {

        $query = "SELECT userid from users WHERE userid='$id' LIMIT 1";
        $DB = new Database();
        $res = $DB->read($query);

        if($res) {
            return true;
        }
        return false;
    }
}
?>
