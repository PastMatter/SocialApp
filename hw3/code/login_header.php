<?php 
session_start();

include_once("classes/connect.php");
include_once("classes/login.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $login = new Login();
    $res = $login->evaluate($_POST);

    if ($res === true) {
        header("Location: profile.php");
        die;
    } else {
        echo "<div style='text-align:center;background-color:grey;'>";
        echo "Please fill all fields!";
        echo $res;
        echo "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login_header.css">
    <title>Login</title>
</head>
<body>
    <div id="left">
        <img src="photos/chitchat.png" alt="">
        <h2>Share, like, comment</h2>
    </div>
    <div id="right">
        <div id="form-container">
            <h2>LOGIN</h2>
            <form method="post">
                <label for="email">Email</label>
                <input name="email" type="text" placeholder='Email' id="email">
                <label for="password">Password</label>
                <input name="password" type="password" placeholder='Password' id="password">
                <input type="submit" value="Login">
                <a href="signin.php">Register</a>
            </form>
        </div>
    </div>
</body>
</html>
