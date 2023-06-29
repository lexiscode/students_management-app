<?php

require "../includes/db_connect.php";
require "includes/get_classroom_id.php";
require "includes/form_validate.php";

// connect to the database server
$conn = connectDB();

// READING or RETRIEVING from the database to get specific article post by their ids
if (isset($_GET['id'])){

    // checks if the article's id exits in the database, then returns an associative array, which stores in $article variable
    $data = getClassroomData($conn, $_GET['id']); // associative array

    if ($data){

        // Get array values from its keys, which then is stored as values in the HTML form below
        $student_class = htmlspecialchars($data['student_class']);
       
    } else {
        // if a non-existing id number is in the link
        die("Invalid ID. No data found");
    }

} else {
    // if no id is in the link
    die("ID not supplied. No data found");
}






if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['save'])){

        $id = $data['id']; // get id for which we wish to edit from
        $student_class = filter_input(INPUT_POST, 'updated_class');

        // checking for empty fields, and throwing error if empty 
        $errors = validateStudentData($student_class);

        if (empty($errors)){

            // update the data into the database server
            $sql = "UPDATE classrooms
                    SET student_class = ?
                    WHERE id = ?";

            // Prepares an SQL statement for execution
            $stmt = mysqli_prepare($conn, $sql);

            // Bind variables for the parameter markers in the SQL statement prepared
            mysqli_stmt_bind_param($stmt, "si", $student_class, $id);

            // Executes a prepared statement
            $results = mysqli_stmt_execute($stmt);

            //Returns the value generated for an AUTO_INCREMENT column by the last query
            $id = mysqli_insert_id($conn);
            
            // it is more advisable to use absolute paths below than relative path
            header("Location: http://localhost/students_management-app/classrooms/index.php"); 
            exit;
        }
    }

}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXISCHOOL</title>
    <link href="../stylings/style.css" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" 
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>
<body style="background-color: whitesmoke; font-family: Arial, sans-serif;">

    <div class="head_container">
        <a href="http://localhost/students_management-app/index.php" style="text-decoration: none;"><h1 class="heading">LexiSchool Management System</h1></a>
    </div>

    <div class="container">
        <!--Introduction header-->
        <h1 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: white">UPDATE CLASS FORM</h1>

        <div class="w-50 m-auto">

            <!-- This prints out the error message(s) of there are any non-filled form in the browser -->
            <?php if (!empty($errors)) : ?>
                <ul>
                    <?php foreach ($errors as $error) : ?>
                        <li style="color: white;"><?= $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>

            <form action="" method="POST">

                <input class="form-control" type="text" name="updated_class" placeholder="Update Classroom" value="<?= htmlspecialchars($data["student_class"]); ?>">
                <br>
                <center><button type="submit" name="save" class="btn btn-success">Update</button></center>
                
            </form>

            <div align="center">
                <i><a class="btn btn-link" href="http://localhost/students_management-app/classrooms/index.php" role="button" style="color: white">Go Back</a></i>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
    
</body>
</html>