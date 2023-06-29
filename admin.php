<?php 

require "includes/db_connect.php"; 
require "includes/auth.php";
require "includes/form_validate.php";

require "pagination/classes/Paginator.php";
require "pagination/classes/GetAll.php";
require "pagination/classes/DbConnect.php";


// Initialize the session.
session_start();

// NB: This below will no longer be necessary if you won't be displaying the new article link page for non-login users
if (!isLoggedIn()){
    
    die("Unauthorized. You must be logged in first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}


// connect to the database server
$conn = connectDB();

/* NB: I skipped using this because I chose to work with paginations below
READING FROM THE DATABASE AND CHECKING FOR ERRORS
$sql = "SELECT * 
        FROM students_record 
        ORDER BY id;";

$results = mysqli_query($conn, $sql); 

$all_data = mysqli_fetch_all($results, MYSQLI_ASSOC);
//print_r($all_data);  prints an associative array
*/


// INDEX FORM INSERTION BELOW (similar to index.php page form)

// Defining the variables in the global
$id = ''; $student_name = ''; $username = ''; $email = ''; $grade = ''; $class = '';


// Check if a new form is submitted and its not empty, then add it to the database
if ($_SERVER["REQUEST_METHOD"] == "POST"){

    if (isset($_POST['save'])){

        require "includes/display_upload.php";

        $student_name = filter_input(INPUT_POST, 'student_name');
        $username = filter_input(INPUT_POST, 'username');
        $email = filter_input(INPUT_POST, 'email');
        $grade = filter_input(INPUT_POST, 'grade');
        $class = filter_input(INPUT_POST, 'class');
        $image = filter_input(INPUT_POST, 'image_file');

        // checking for empty fields, and throwing error if empty 
        $errors = validateForm($student_name, $username, $email, $grade, $class);

        if (empty($errors)){
                
            // makes the message field "null" if not filled
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
            header("Location: http://localhost/students_management-app/admin.php"); 
            exit;
        }
    }
}


// Fetch data (Reading) from the classrooms table
$query = "SELECT * FROM classrooms";
$result = mysqli_query($conn, $query);
$all_classes = mysqli_fetch_all($result, MYSQLI_ASSOC);


// connect to the database 
$db = new DbConnect();
$conn = $db->getConn();
// PAGINATION
// using null-coalescing operator to set default page parameters and isset parameters in one line
$paginator = new Paginator($_GET['page'] ?? 1, 5, GetAll::getTotalRecords($conn));

// READING from database (students_record table) and checking for errors
$all_data = GetAll::getPage($conn, $paginator->limit, $paginator->offset);

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LEXISCHOOL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  </head>
  <body style="background-color: #371777"> 

  <div class="container">
        <!--Introduction header-->
        <a href="http://localhost/students_management-app/index.php" style="text-decoration: none;"><h1 class="text-center my-4 py-4" style="font-family: Tahoma, Verdana, Segoe, sans-serif; color: white">LexiSchool Management System</h1></a>

        <div class="container text-center">
            <div class="row">
                <!-- GRID 1 -->
                <div class="col">
                    
                    <!-- Button trigger modal -->
                    <div align="right">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                        Apply Now!
                        </button>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-content" style="background-color: gray">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel" style="color: white">Fill Student Form</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <div class="w-45 m-auto">
                                    <!-- This prints out the error message(s) of there are any non-filled form in the browser -->
                                    <?php if (!empty($errors)) : ?>
                                        <ul>
                                            <?php foreach ($errors as $error) : ?>
                                                <li style="color: white;"><?= $error ?></li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>

                                    <!--HTML form-->
                                    <?php require "./includes/admin_form.php"; ?>
                
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="save">Submit</button>
                            </div>
                            </div>
                        </form>
                    </div>
                    </div>

                </div>
                <!-- GRID 2 -->
                <div class="col" align="center">
                    
                    <form action="" method="POST">
                        <button type="submit" class="btn btn-success"><a href="http://localhost/students_management-app/classrooms/index.php" style="text-decoration: none; color: white;">Set Classrooms</a></button>
                    </form>
                </div>
                
                <!-- GRID 3 -->
                <div class="col" align="left">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Chart Reports
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/students_management-app/chart_reports/bar.php" target="_blank">Bar Chart</a></li>
                        <li><a class="dropdown-item" href="/students_management-app/chart_reports/pie.php" target="_blank">Pie Chart</a></li>
                        <li><a class="dropdown-item" href="/students_management-app/chart_reports/line.php" target="_blank">Line Chart</a></li>
                        <li><a class="dropdown-item" href="/students_management-app/chart_reports/doughnut.php" target="_blank">Doughnut Chart</a></li>
                    </ul>
                
                </div>
            </div>
        </div>

        
        <br>

        <!--Horizontal line demacation-->
        <hr class="bg-dark w-50 m-auto">

        <!-- Table class="w-50 m-auto"-->
        <div class="container-fluid">
            
            <div style="margin: 25px 50px 25px 50px; background-color: black; color: white; border-radius:20px">
                <h1 align="center">Booking Database Table</h1>
            </div>

            <table class="table table-dark table-hover">
                <thead align="center">
                    <tr>

                    <th scope="col" class="table-secondary">#ID</th>
                    <th scope="col" class="table-secondary">NAME</th>
                    <th scope="col" class="table-secondary">USERNAME</th>
                    <th scope="col" class="table-secondary">EMAIL</th>
                    <th scope="col" class="table-secondary">GRADE</th>
                    <th scope="col" class="table-secondary">CLASS</th>
                    <th scope="col" class="table-secondary">VIEW</th>
                    <th scope="col" class="table-secondary">ACTION</th>
                    </tr>
                </thead>

                <?php if (!empty($all_data)): ?>

                <tbody align="center">

                    <?php foreach ($all_data as $key => $data): ?>
                        <tr>
                            <td>REG<?= $data["id"] ?></td> 
                            <td><?= htmlspecialchars($data["student_name"]) ?></td>
                            <td><?= htmlspecialchars($data["username"]) ?></td>
                            <td><?= htmlspecialchars($data["email"]) ?>@lexischool.com</td>
                            <td><?= htmlspecialchars($data["grade"]) ?></td>
                            <td><?= htmlspecialchars($data["class"]) ?></td>
                            <td><?php require "includes/show.php" ?></td>
                            <td><a class="btn btn-primary" href="edit_data.php?id=<?= $data["id"]; ?>">Edit</a> <a class="btn btn-danger" href="delete_data.php?id=<?= $data['id']; ?>">Delete</a></td>
                        </tr>
                    <?php endforeach; ?>

                </tbody>

                <?php else: ?>
                    <p style="color: white;">No data found.</p>
                <?php endif; ?>
                
            </table>

            <!-- PAGINATION -->
            <?php require "pagination/paginate.php"; ?>
            
            
            <div align="center">
                <i><a class="btn btn-link" href="index.php" role="button" style="color: white">Back to Homepage</a></i>
            </div>
            
        </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>

    <!-- checking image dimension to be uploaded-->
    <script src="js/img_dimension.js"></script>
    
</body>
</html>
