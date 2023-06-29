<?php

require "../includes/db_connect.php";
require "includes/form_validate.php";
require "../includes/auth.php";

require "pagination/classes/Paginator.php";
require "pagination/classes/GetAll.php";
require "pagination/classes/DbConnect.php";


// error handler function
function myErrorHandler($errno, $errstr){
    echo "<b>Error:</b> [$errno] $errstr";
}
// set error handler function
set_error_handler("myErrorHandler");


// Initialize the session.
session_start();

// This will make this page not accessible to non-logined users (non-admins)
if (!isLoggedIn()){
    
    die("Unauthorized. You must be logged in first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}


// connect to the database server
$conn = connectDB();

/* Pagination has replaced my using of this code below
READING FROM THE DATABASE AND CHECKING FOR ERRORS
$sql = "SELECT * 
        FROM classrooms 
        ORDER BY id;";

$results = mysqli_query($conn, $sql); 

$all_classrooms = mysqli_fetch_all($results, MYSQLI_ASSOC);
//print_r($all_classrooms);  prints an associative array
*/

// Check if the "Clear All" button was clicked
if(isset($_POST['clear_classrooms'])) {

    // SQL query to delete all data from the table
    // $sql = DELETE FROM rooms_record
    $sql = "TRUNCATE TABLE classrooms";

    // Execute the SQL query
    mysqli_query($conn, $sql);

    header("Location: http://localhost/students_management-app/classrooms/index.php");
    exit;
}


// Defining the variables in the global
$student_class = '';

// Check if a new form is submitted and its not empty, then add it to the database
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['save'])){

        $student_class = filter_input(INPUT_POST, 'new_classroom');

        // checking for empty fields, and throwing error if empty 
        $errors = validateStudentData($student_class);
       
        // the ADD or CREATE functionality should go through if no errors (non-empty fields) are encountered
        if (empty($errors)) {
    
            // connect to the database server
            $conn = connectDB();

            // inserts the data into the database server
            $sql = "INSERT INTO classrooms (student_class)
                    VALUES (?)";

            // Prepares an SQL statement for execution
            $stmt = mysqli_prepare($conn, $sql);

            // Bind variables for the parameter markers in the SQL statement prepared
            mysqli_stmt_bind_param($stmt, "s", $student_class);

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


// connect to the database 
$db = new DbConnect();
$conn = $db->getConn();

// PAGINATION
// using null-coalescing operator to set default page parameters and isset parameters in one line
$paginator = new Paginator($_GET['page'] ?? 1, 4, GetAll::getTotalRecords($conn));

// READING from database (classrooms table) and checking for errors
$all_classrooms = GetAll::getPage($conn, $paginator->limit, $paginator->offset);



/* Numbering the Classroom list
function classNumber(){
    static $a = 1;
    echo $a;
    $a++;
}
*/

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LEXISCHOOL</title>
    <link href="../stylings/style.css" rel="stylesheet" type="text/css" >
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body style="background-color: whitesmoke; font-family: Arial, sans-serif;">

    <div class="head_container">
        <a href="http://localhost/students_management-app/index.php" style="text-decoration: none;"><h1 class="heading">LexiSchool Management System</h1></a>
    </div>

    <div class="container">
        <!--Introduction header-->
        <h1 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: white;">My Classrooms</h1>

        <!--First Top Form-->
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
                <label for="new_classroom" style="color: white;">New Classroom:</label>
                <input class="form-control" type="text" name="new_classroom" id="new_classroom" placeholder="Enter New Classroom To Add">
                <br>
               
                <button type="submit" class="btn btn-success" name="save">Add Classroom</button>
                <button type="submit" class="btn btn-secondary" name="clear_classrooms">Clear Lists</button>
            </form>
        </div>
        <br>

        <!--Horizontal line demacation-->
        <hr class="bg-dark w-50 m-auto" style="color: white">

        <!-- Table class="w-50 m-auto"-->
        <div class="w-50 m-auto">
            <h1 style="color: white">Your Lists</h1>

            <table class="table table-dark table-hover">
                <thead align="center">
                    <tr>
                    <th scope="col" class="table-secondary">ROOMS</th>
                    <th scope="col" class="table-secondary">ALL CLASSES</th>
                    <th scope="col" class="table-secondary">ACTIONS</th>
                    </tr>
                </thead>

                <?php if (!empty($all_classrooms)) : ?>

                <tbody align="center">
                    <?php foreach ($all_classrooms as $index => $class): ?>
                        <tr>

                            
                            <td>RUM <?= ($class["id"]); ?></td>
                            <td><?= htmlspecialchars($class["student_class"]); ?></td>
                            <td> 
                            <a class="btn btn-danger btn-sm" href="http://localhost/students_management-app/classrooms/delete_class.php?id=<?= $class['id']; ?>">Delete</a> <a class="btn btn-primary btn-sm" href="http://localhost/students_management-app/classrooms/edit_class.php?id=<?= $class['id']; ?>">Edit</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </tbody>

                <?php else : ?>
                    <p>No lists found.</p>
                <?php endif; ?>

            </table>

            <!-- PAGINATION -->
            <?php require "pagination/paginate.php"; ?>
            

            <div align="center">
                <i><a class="btn btn-link" href="http://localhost/students_management-app/admin.php" role="button" style="color: white">Back to Database Page</a></i>
            </div>
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

  </body>
</html>