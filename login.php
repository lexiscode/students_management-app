<?php

require "includes/user_login.php";
require "includes/auth.php";

// initializes the session
session_start();

if (isLoggedIn()){
    
    die("Unauthorized. You must be logged out first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // filters the username and password inputs gotten from the site
    $inputed_username = filter_input(INPUT_POST, 'username');
    $inputed_password = filter_input(INPUT_POST, 'password');

    $login_data = fetchLoginData($conn, $inputed_username);

    if ($login_data && password_verify($inputed_password, $login_data['password'])) {

        // this helps prevent session fixation attacks
        session_regenerate_id(true);

        $_SESSION['is_logged_in'] = true;

        // redirect to the admin page
        header('Location: http://localhost/students_management-app/admin.php');
        exit;
    } else {

        $error = "Login incorrect";
    }
}

?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./stylings/login.css">
</head>

<body>

    <a href="http://localhost/students_management-app/index.php"><h1>LexiSchool Management System</h1></a>
    <br>
    <h2>LOGIN</h2>

    <?php if (!empty($error)) : ?>
        <p align="center" style="color: white;"><?= $error ?></p>
    <?php endif; ?>

    <div class="container">
        <form method="POST" action="">
            <label for="username">Username</label>
            <input type="text" name="username" id="username">
            <br> <br>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <br> <br>

            <center><button type="submit">Sign in</button></center>
        </form>
    </div>
</body>

</html>
