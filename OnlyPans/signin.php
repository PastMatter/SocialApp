<?php 

include_once("classes/connect.php");
include_once("classes/signup.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $signup = new Signup();
    $res = $signup->evaluate($_POST);

    if($res != true) {
        echo "<div style='text-align:center;background-color:grey;'>";
        echo "Please fill all fields!";
        echo $res;
        echo "</div>";
    }
    else {
        header("Location: login_header.php");
        die;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signin.css">
    <title>Sign Up</title>
</head>
<body>
    <div id="left">
        <img src="logo.png" alt="">
        <h2>Sign up to support your favorite creators</h2>
    </div>
    <div id="right">
        <div id="form-container">
            <h3>SIGN IN</h3>
            <form action="" method="post">
                <input name="first_name" type="text" placeholder='Name'>
                <input name="last_name" type="text" placeholder='Surname'>
                <input name="email" type="text" placeholder='Email'>
                <input name="username" type="text" placeholder='Username' id="username">
                <input name="password" type="password" placeholder='Password'>
                <input name="sub_btn" type="submit" value="Sign Up">
            </form>
        </div>
    </div>
</body>
</html>
