<?php

include_once("connect.php");

class Post {

    private $error = "";

    function create_post($userid, $data) {
        print_r($data);
        if(!empty($data['post_content'])) {
            $post = addslashes($data['post_content']);
            $postid = $this->create_postid();
            $query = "INSERT INTO posts (userid, post, postid) VALUES ('$userid', '$post', '$postid')";

            $DB = new Database();
            $DB->save($query);
        } else {
            $this->error .= "post cannot be empty<br>";
        }
        return $this->error;
    }

    function create_postid() {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number .= $new_rand;
        }
        return $number;
    }

    function get_posts($id) {
        $query = "SELECT * FROM posts WHERE userid='$id' ORDER BY id DESC";

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