<?php

/**
 * Gets the database connection
 * 
 * @return object Connection to a MySQL server
 */

// CONNECTING TO THE DATABASE AND CHECKING FOR ERRORS
function connectDB(){

    $db_host = "localhost";
    $db_name = "students_management_system";
    $db_user = "lexischool_db";
    $db_password = "uZNxL5*_mhWmA8vP";

    $conn = mysqli_connect($db_host, $db_user, $db_password, $db_name);

    if(mysqli_connect_error()){
        echo mysqli_connect_error();
        exit;
    }

    return $conn;
}