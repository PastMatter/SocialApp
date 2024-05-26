<?php
session_start();

include_once("classes/connect.php");
include_once("classes/login.php");
include_once("classes/user.php");
include_once("classes/post.php");

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $viewed_user_id = $_GET['id'];
    $user = new User();
    $viewed_user_data = $user->get_data($viewed_user_id);
    
    if (!$viewed_user_data) {
        echo "User not found.";
        die;
    }

    $post = new Post();
    $viewed_user_posts = $post->get_posts($viewed_user_id);
} else {
    echo "Invalid user ID.";
    die;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "{$viewed_user_data['first_name']} {$viewed_user_data['last_name']}'s Profile"; ?></title>
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
            <h2><?php echo "{$viewed_user_data['first_name']} {$viewed_user_data['last_name']}"; ?></h2>
        </aside>
        <main class="main-content">
            <h2>Posts by <?php echo "{$viewed_user_data['first_name']}"; ?></h2>
            <div class="posts">
                <?php
                if ($viewed_user_posts) {
                    foreach ($viewed_user_posts as $row) {
                        echo "<div class='post'>
                                <div class='post-header'>
                                    <img src='photos/friend1.jfif' alt='{$viewed_user_data['first_name']}' class='post-avatar'>
                                    <span class='post-username'>{$viewed_user_data['first_name']} {$viewed_user_data['last_name']}</span>
                                </div>
                                <p>{$row['post']}</p>
                                <button class='like-btn'>Like</button>
                                <button class='comment-btn'>Comment</button>
                              </div>";
                    }
                } else {
                    echo "<p>No posts yet.</p>";
                }
                ?>
            </div>
        </main>
    </div>
</body>
</html>
