<?php 

class Database {

    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db = "only_pans_db";

    function connect() {
        $connection = mysqli_connect($this->host, $this->username, $this->password, $this->db);
        return $connection;
    }

    function read($query) {
        $conn = $this->connect();
        $res = mysqli_query($conn, $query);

        if (!$res) {
            return false;
        } else {
            $arr = [];
            while ($row = mysqli_fetch_assoc($res)) {
                $arr[] = $row;
            }
            return $arr;
        }
    }

    function save($query) {
        $conn = $this->connect();
        $res = mysqli_query($conn, $query);

        if (!$res) {
            return false;
        } else {
           return true; 
        }
    }
}
?>
