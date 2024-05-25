<?php
session_start();

include_once("classes/connect.php");
include_once("classes/login.php");
include_once("classes/user.php");

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
    // Handle form submission logic here
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <style>
    body {
      min-height: 100vh;
      background-color: #f4f4f5; /* Equivalent to bg-zinc-100 */
      color: #18181b; /* Equivalent to text-zinc-900 */
      margin: 0;
      padding: 0;
    }
    .dark-mode body {
      background-color: #18181b; /* Equivalent to dark:bg-zinc-900 */
      color: #f4f4f5; /* Equivalent to dark:text-zinc-100 */
    }
    header {
      background-color: #2563eb; /* Equivalent to bg-blue-600 */
      padding: 1rem;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    header img {
      height: 2.5rem; /* Equivalent to h-10 */
    }
    .header-input {
      padding: 0.5rem;
      border-radius: 0.5rem; /* Equivalent to rounded-lg */
      width: 16rem; /* Equivalent to w-64 */
    }
    .header-avatar {
      height: 2.5rem; /* Equivalent to h-10 */
      width: 2.5rem; /* Equivalent to w-10 */
      border-radius: 50%; /* Equivalent to rounded-full */
    }
    .container {
      display: flex;
    }
    aside {
      background-color: #22c55e; /* Equivalent to bg-green-500 */
      width: 25%; /* Equivalent to w-1/4 */
      padding: 1rem;
    }
    .friend {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }
    .friend img {
      height: 3rem; /* Equivalent to h-12 */
      width: 3rem; /* Equivalent to w-12 */
      border-radius: 50%; /* Equivalent to rounded-full */
      margin-right: 1rem;
    }
    main {
      flex: 1;
      background-color: #ef4444; /* Equivalent to bg-red-500 */
      padding: 1rem;
    }
    .form-container {
      background-color: white;
      padding: 1rem;
      border-radius: 0.5rem; /* Equivalent to rounded-lg */
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-md */
      margin-bottom: 1rem;
    }
    .form-container textarea {
      width: 100%;
      padding: 0.5rem;
      border-radius: 0.5rem; /* Equivalent to rounded-lg */
      border: 1px solid #d1d5db; /* Equivalent to border-zinc-300 */
    }
    .form-container button {
      background-color: #2563eb; /* Equivalent to bg-blue-600 */
      color: white;
      padding: 0.5rem;
      border-radius: 0.5rem; /* Equivalent to rounded-lg */
      margin-top: 0.5rem;
    }
    .post {
      background-color: #dbeafe; /* Equivalent to bg-blue-100 */
      padding: 1rem;
      border-radius: 0.5rem; /* Equivalent to rounded-lg */
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.1); /* Equivalent to shadow-md */
    }
    .post .post-header {
      display: flex;
      align-items: center;
      margin-bottom: 1rem;
    }
    .post .post-header img {
      height: 6rem; /* Equivalent to h-24 */
      width: 6rem; /* Equivalent to w-24 */
      border-radius: 50%; /* Equivalent to rounded-full */
      margin-right: 1rem;
    }
    .post .post-footer {
      display: flex;
      justify-content: flex-end;
    }
    .post .post-footer a {
      color: #2563eb; /* Equivalent to text-blue-600 */
      margin-left: 1rem;
    }
  </style>
  <title>OnlyPans</title>
</head>
<body>
  <div class="dark-mode">
    <div class="min-h-screen">
      <header>
        <img src="https://placehold.co/100x50" alt="Logo">
        <div class="flex items-center space-x-4">
          <input type="text" placeholder="Search..." class="header-input">
          <img src="<?php echo $user_data['profile_image']; ?>" alt="User Avatar" class="header-avatar">
        </div>
      </header>
      <div class="container">
        <aside>
          <div class="friend">
            <img src="<?php echo $user_data['profile_image']; ?>" alt="User Avatar">
            <span><?php echo $user_data['first_name'] . " " . $user_data['last_name']; ?></span>
          </div>
          <div class="friend">
            <img src="https://placehold.co/50x50" alt="User Avatar">
            <span>friend2</span>
          </div>
        </aside>
        <main>
          <form action="submit.php" method="post" class="form-container">
            <textarea name="post_content" placeholder="Let me cook"></textarea>
            <button type="submit">Submit</button>
          </form>
          <div class="post">
            <div class="post-header">
              <img src="<?php echo $user_data['profile_image']; ?>" alt="User Avatar">
              <p class="flex-1">
              I love to cook. I am chef in 5 star restaurant. Be sure to check my profile and follow for more content...
              </p>
            </div>
            <div class="post-footer">
              <a href="#">Like</a>
              <a href="#">Comment</a>
            </div>
          </div>
        </main>
      </div>
    </div>
  </div>
</body>
</html>
