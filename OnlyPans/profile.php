<?php
session_start();

include_once("classes/connect.php");
include_once("classes/login.php");
include_once("classes/user.php");
include_once("classes/post.php");

if (isset($_SESSION['only_pans_userid']) && is_numeric($_SESSION['only_pans_userid'])) {
    $id = $_SESSION['only_pans_userid'];
    $login = new Login();
    $res = $login->check_login($id);

    if ($res) {
        $user = new User();
        $user_data = $user->get_data($id);
    } else {
        header("Location: login_header.php");
        die;
    }
} else {
    header("Location: login_header.php");
    die;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $post = new Post();
    $id = $_SESSION['only_pans_userid'];
    $res = $post->create_post($id, $_POST);

    if ($res == "") {
        header("Location: profile.php");
        die;
    } else {
        echo $res;
    }
}

$post = new Post();
$id = $_SESSION['only_pans_userid'];
$posts = $post->get_posts($id);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <nav class="navbar">
        <a href="/" class="navbar__logo">OnlyPans</a>
        <div class="navbar__toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
         </div>
         <div class="navbar-menu">
             <a href="home.php" class="navbar__link">Home</a>
             <a href="logout.php" class="navbar__link">Logout</a>
         </div>
    </nav>
    <div class="container">
        <aside class="sidebar">
            <h2>Friends</h2>
            <ul>
                <?php
                // Fetch friends dynamically if possible, here are some static examples
                echo "<li><a href='#'>{$user_data['first_name']} {$user_data['last_name']}</a></li>";
                echo "<li><a href='#'>Friend 2</a></li>";
                echo "<li><a href='#'>Friend 3</a></li>";
                echo "<li><a href='#'>Friend 4</a></li>";
                ?>
            </ul>
        </aside>
        <main class="main-content">
            <form class="post-form" method="post">
                <textarea name="post_content" placeholder="What's on your mind?" action="profile.php" required></textarea>
                <button type="submit">Post</button>
            </form>
            <div class="posts">
                <?php
                if ($posts) {
                    foreach ($posts as $row) {
                        $user = new User();
                        $row_user = $user->get_data($row['userid']);
                        echo "<div class='post'>
                                <div class='post-header'>
                                    <img src='friend1.jfif' alt='{$row_user['first_name']}' class='post-avatar'>
                                    <span class='post-username'>{$row_user['first_name']} {$row_user['last_name']}</span>
                                </div>
                                <p>{$row['post']}</p>
                                <button class='like-btn'>Like</button>
                                <button class='comment-btn'>Comment</button>
                              </div>";
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>


