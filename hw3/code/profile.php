<?php
// Start the session and include necessary files
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
    $res = $post->create_post($id, $_POST);

    if ($res == "") {
        header("Location: profile.php");
        die;
    } else {
        echo $res;
    }
}

if (isset($_GET['action']) && isset($_GET['userid'])) {
    $action = $_GET['action'];
    $followed_id = $_GET['userid'];
    $id = $_SESSION['only_pans_userid'];

    if ($action == 'follow') {
        $user->follow($id, $followed_id);
    } elseif ($action == 'unfollow') {
        $user->unfollow($id, $followed_id);
    }

    header("Location: profile.php");
    die;
}


$post = new Post();
$posts = $post->get_posts($id);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="index-new.css">
</head>
<body>
    <nav class="navbar">
        <a href="/" class="navbar__logo">ChitChat</a>
        <div class="navbar__toggle" id="mobile-menu">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
        <div class="navbar-menu">
            <a href="logout.php" class="navbar__link">Logout</a>
        </div>
    </nav>
    <div class="container">
        <aside class="sidebar">
            <h2>Friends</h2>
            <ul>
                <?php
                $following = $user->get_following($id);
                if ($following) {
                    foreach ($following as $followed_user) {
                        $followed_user_data = $user->get_data($followed_user['followed_id']);
                        if ($followed_user_data) {
                            echo "<li><a href='view_profile.php?id={$followed_user_data['userid']}'>{$followed_user_data['first_name']} {$followed_user_data['last_name']}</a></li>";
                        }
                    }
                }
                ?>
            </ul>
            <h2>Suggestions</h2>
            <ul>
                <?php
                $random_users = $user->get_random_users($id);
                if ($random_users) {
                    foreach ($random_users as $random_user) {
                        $is_following = $user->is_following($id, $random_user['userid']);
                        $rand_id = $random_user['userid'];
                        $follow_action = $is_following ? 'unfollow' : 'follow';
                        $follow_text = $is_following ? 'Unfollow' : 'Follow';
                        echo "<li>
                                <a href='view_profile.php?id={$random_user['userid']}'>{$random_user['first_name']} {$random_user['last_name']}</a>
                                <a href='profile.php?action={$follow_action}&userid={$rand_id}' class='follow-btn'>{$follow_text}</a>
                              </li>";
                    }
                }
                ?>
            </ul>
        </aside>
        <main class="main-content">
            <form class="post-form" method="post">
                <textarea name="post_content" placeholder="What's on your mind?" required></textarea>
                <button type="submit">Post</button>
            </form>
            <div class="posts">
                <?php
                if ($posts) {
                    foreach ($posts as $row) {
                        $row_user = $user->get_data($row['userid']);
                        if ($row_user) {
                            echo "<div class='post'>
                                    <div class='post-header'>
                                        <img src='photos/friend1.jfif' alt='{$row_user['first_name']}' class='post-avatar'>
                                        <span class='post-username'>{$row_user['first_name']} {$row_user['last_name']}</span>
                                    </div>
                                    <p>{$row['post']}</p>
                                    <button class='like-btn'>Like</button>
                                    <button class='comment-btn'>Comment</button>
                                  </div>";
                        }
                    }
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>
