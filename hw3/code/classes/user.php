<?php

include_once("connect.php");

class User {

    function get_data($id) {
        $query = "SELECT * FROM users WHERE userid='$id' LIMIT 1";
        $DB = new Database();
        $res = $DB->read($query);

        if ($res) {
            return $res[0];
        } else {
            return false;
        }
    }

    function get_user($id) {
        $query = "SELECT * FROM users WHERE userid='$id' LIMIT 1";
        $DB = new Database();
        $res = $DB->read($query);
        
        if ($res) {
            return $res;
        } else {
            return false;
        }
    }

    function follow($follower_id, $followed_id) {
        $DB = new Database();
        $check_query = "SELECT * FROM followers WHERE follower_id='$follower_id' AND followed_id='$followed_id'";
        $check_res = $DB->read($check_query);

        if (!$check_res) {
            $query = "INSERT INTO followers (follower_id, followed_id) VALUES ('$follower_id', '$followed_id')";
            $DB->save($query);
        }
    }

    function unfollow($follower_id, $followed_id) {
        $query = "DELETE FROM followers WHERE follower_id='$follower_id' AND followed_id='$followed_id'";
        $DB = new Database();
        $DB->save($query);
    }
    

    function is_following($follower_id, $followed_id) {
        $query = "SELECT * FROM followers WHERE follower_id='$follower_id' AND followed_id='$followed_id'";
        $DB = new Database();
        $res = $DB->read($query);
        return $res ? true : false;
    }

    function get_following($user_id) {
        $query = "SELECT * FROM followers WHERE follower_id='$user_id'";
        $DB = new Database();
        $res = $DB->read($query);
        return $res;
    }

    function get_random_users($user_id, $limit = 5) {
        $query = "SELECT * FROM users WHERE userid != '$user_id' ORDER BY RAND() LIMIT $limit";
        $DB = new Database();
        $res = $DB->read($query);
        return $res;
    }
}
?>
