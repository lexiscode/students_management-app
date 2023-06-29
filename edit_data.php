<?php

require "includes/db_connect.php";
require "includes/get_student_data_id.php";
require "includes/form_validate.php";
require "includes/auth.php";


// Initialize the session.
session_start();

// NB: This below will no longer be necessary if you won't be displaying the new article link page for non-login users
if (!isLoggedIn()){
    
    die("Unauthorized. You must be logged in first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}

// connect to the database server
$conn = connectDB();

// READING or RETRIEVING from the database to get specific "students_record" post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $data = getStudentData($conn, $_GET['id']); // associative array

    if ($data){
        // Get array values from its keys, which then is stored as values in the HTML form below
        $student_name = htmlspecialchars($data['student_name']);
        $email = htmlspecialchars($data['email']);
        $username = htmlspecialchars($data['username']);
        $grade = htmlspecialchars($data['grade']);
        $class = htmlspecialchars($data['class']);
        $image_file = htmlspecialchars($data['image_file']);
       
    } else {
        // if a non-existing id number is in the link
        die("Invalid ID. No data found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No data found");
}
       


// REPEAT VALIDATION, no need declaring of variables anymore
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['save'])){

        require "includes/display_upload.php";

        $id = $data['id']; // get id for which we wish to edit from
        $student_name = filter_input(INPUT_POST, 'student_name');
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $grade = filter_input(INPUT_POST, 'grade');
        $class = filter_input(INPUT_POST, 'class');
        

        // checking for empty fields, and throwing error if empty 
        $errors = validateForm($student_name, $username, $email, $grade, $class);

        // UPDATE functionality
        if (empty($errors)){
                
            // makes the message field "null" if not filled
            if ($filename == ''){
                $filename = null;
            }


            // connect to the database server
            $conn = connectDB();
            
            // update the data into the database server
            $sql = "UPDATE students_record 
                    SET student_name = ?, username = ?, email = ?, grade = ?, class = ?, image_file = ?
                    WHERE id = ?";

            // Prepares an SQL statement for execution
            $stmt = mysqli_prepare($conn, $sql);

           

            // Bind variables for the parameter markers in the SQL statement prepared
            // $id parameter must be included here at the end of the statement
            mysqli_stmt_bind_param($stmt, "ssssssi", $student_name, $username, $email, $grade, $class, $filename, $id);

            // Executes a prepared statement
            $results = mysqli_stmt_execute($stmt);

            //Returns the value generated for an AUTO_INCREMENT column by the last query
            $id = mysqli_insert_id($conn);
            
            // it is more advisable to use absolute paths below than relative path
            header("Location: http://localhost/students_management-app/admin.php"); 
            exit;
        }
    }

}


// Fetch data from the classrooms table
$query = "SELECT * FROM classrooms";
$result = mysqli_query($conn, $query);
$all_classes = mysqli_fetch_all($result, MYSQLI_ASSOC);

?>



<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXISCHOOL</title>
    <link href="./stylings/style.css" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body style="background-color: whitesmoke; font-family: Arial, sans-serif;">

    <div class="head_container">
        <h1 class="heading">LexiSchool Management System</h1>
    </div>

    <div class="container">
        <!--Introduction header-->
        <h1 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: white">UPDATE STUDENT FORM</h1>

        <div class="w-50 m-auto">

            <!-- This prints out the error message(s) of there are any non-filled form in the browser -->
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li style="color: white;"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <!-- Using the grid layout style-->
            <form class="row g-3" method="POST" enctype="multipart/form-data"> 

            <?php require "./includes/the_form_retrieve.php" ?>
            
            <br> <br>

            </form>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- checking image dimension to be uploaded-->
    <script src="js/img_dimension.js"></script>
    
</body>

</html>