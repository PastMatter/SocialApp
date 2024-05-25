<?php

include_once("connect.php");

class User {

    function get_data($id) {

        $query = "SELECT * FROM users WHERE userid='$id' LIMIT 1";
        $DB = new Database();
        $res = $DB->read($query);

        if($res) {

            $row = $res[0];
            return $row;

        } else {
            return false;
        }
    }

    function get_user($id) {

        $query = "SELECT * FROM users WHERE userid='$id' LIMIT 1";

        $DB = new Database();
        $res = $DB->read($query);
        
        if($res) {
            return $res;
        } else {
            return false;
        }
    }
}

?>