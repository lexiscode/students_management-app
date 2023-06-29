<?php

require "includes/db_connect.php";
require "includes/auth.php";
require "includes/form_validate.php";


// error handler function
function myErrorHandler($errno, $errstr){
    echo "<b>Error:</b> [$errno] $errstr";
}
// set error handler function
set_error_handler("myErrorHandler");


// Initialize the session.
session_start();

// connect to the database server
$conn = connectDB();

// Defining the variables in the global
$student_name = ''; $username= ''; $email = ''; $grade = ''; $class = '';

// Check if a new form is submitted and its not empty, then add it to the database
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['save'])){

        require "includes/display_upload.php";

        $student_name = filter_input(INPUT_POST, 'student_name');
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $grade = filter_input(INPUT_POST, 'grade');
        $class = filter_input(INPUT_POST, 'class');

        // checking for empty fields, and throwing error if empty 
        $errors = validateForm($student_name, $username, $email, $grade, $class);
       
        // the ADD or CREATE functionality should go through if no errors (non-empty fields) are encountered
        if (empty($errors)) {
                
            // makes the image upload field "null" if not filled
            if ($filename == ''){
                $filename = null;
            }

            // inserts the data into the database server
            $sql = "INSERT INTO students_record (student_name, username, email, grade, class, image_file)
                    VALUES (?, ?, ?, ?, ?, ?)";

            // Prepares an SQL statement for execution
            $stmt = mysqli_prepare($conn, $sql);

            // Bind variables for the parameter markers in the SQL statement prepared
            mysqli_stmt_bind_param($stmt, "ssssss", $student_name, $username, $email, $grade, $class, $filename);

            // Executes a prepared statement
            $results = mysqli_stmt_execute($stmt);

            //Returns the value generated for an AUTO_INCREMENT column by the last query
            $id = mysqli_insert_id($conn);
            
            // it is more advisable to use absolute paths below than relative path
            header("Location: http://localhost/students_management-app/student_data.php?id=$id"); 
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
        <h1 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: white">STUDENTS FORM</h1>

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

            <?php require "./includes/the_form.php" ?>
            
            <br> <br>

            </form>
        

            <!-- Working with Sessions-->
            <center>
            <?php if (isLoggedIn()) : ?>
                <p style="color: white">You are logged in. <a href="logout.php">Logout</a></p>
                <!-- only logged in user should access this link below-->
                <a href="admin.php" target="_blank">Go To Database</a>
            <?php else : ?>
                <p style="color: white">Are you an admin? If yes, <a href="login.php" target="_blank">Login</a>!</p>
            <?php endif; ?>
            </center>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <!-- checking image dimension to be uploaded-->
    <script src="js/img_dimension.js"></script>
    
</body>

</html>