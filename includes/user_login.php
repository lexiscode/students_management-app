<?php

require "db_connect.php";

// connect to the database server
$conn = connectDB();

function fetchLoginData($conn, $username)
{
    $sql = "SELECT * 
            FROM user
            WHERE username = '$username'";

    $result = mysqli_query($conn, $sql);

    return mysqli_fetch_assoc($result);
}