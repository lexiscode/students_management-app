<?php

/**
 * Get the classroom record based on the ID
 * 
 * @param object $conn connection to the database
 * @param integer $id the classroom ID
 * 
 * @return mixed An associative array containing the classroom with that ID, or null if not found
 */

function getClassroomData($conn, $id){

    // This GETS an article row from the database by id
    $sql = "SELECT * FROM classrooms WHERE id = ?";

    // Prepares an SQL statement for execution
    $stmt = mysqli_prepare($conn, $sql);

    // Bind variables for the parameter markers in the SQL statement prepared
    mysqli_stmt_bind_param($stmt, "i", $id);

    // Executes a prepared statement
    $result = mysqli_stmt_execute($stmt);
            
    // Gets a result set from a prepared statement as an object
    $get_result = mysqli_stmt_get_result($stmt);
            
    // Fetch the next row of a result set as an associative, a numeric array, or both you can use
    // return mysqli_fetch_array($get_result, MYSQLI_ASSOC);
    return mysqli_fetch_assoc($get_result);
    
}