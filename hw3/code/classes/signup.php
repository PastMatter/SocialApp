<?php

include_once("connect.php");

class Signup {

    function evaluate($data) {
        $error = "";
        foreach ($data as $key => $value) {
            if (empty($value)) {
                $error .= $key . " is empty!<br>";
            }
        }
        if ($error == "") {
            return $this->create_user($data);
        } else {
            return $error;
        }
    }

    function create_user($data) {
        $first_name = $data['first_name'];
        $last_name = $data['last_name'];
        $email = $data['email'];
        $password = $data['password'];

        $url_address = strtolower($first_name) . "." . strtolower($last_name);
        $userid = $this->create_userid();

        $query = "INSERT INTO users 
        (userid, first_name, last_name, email, password, url_address) 
        VALUES ('$userid', '$first_name', '$last_name', '$email', '$password', '$url_address')";
        $Db = new Database();
        return $Db->save($query);
    }

    function create_userid() {
        $length = rand(4, 19);
        $number = "";
        for ($i = 0; $i < $length; $i++) {
            $new_rand = rand(0, 9);
            $number .= $new_rand;
        }
        return $number;
    }
}
?>
