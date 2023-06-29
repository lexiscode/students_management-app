<?php

require "includes/db_connect.php";
require "includes/get_student_data_id.php";

// connect to the database server
$conn = connectDB();

// This gets the id from the browser tab when the save button was clicked in the new article page
if (isset($_GET['id'])){

    // Reading from the database to get specific article row by their id
    $data = getStudentData($conn, $_GET['id']); // this holds an associative array
    
} else {
    // no error message printed when there's no id included in the url link
    $data = null; 
}



// download to pdf file
if (isset($_POST['download'])){

    header("Location: http://localhost/students_management-app/print_pdf.php?id={$data['id']}");
    exit;
}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXISCHOOL</title>
    <link href="./stylings/student_data.css" rel="stylesheet">
</head>
<body style="background-color: #371777; font-family: Arial, sans-serif;">

    <h1 class="heading"><a href="http://localhost/students_management-app/index.php" style="text-decoration: none">LexiSchool Management System</a></h1>

    <div>
        <?php if ($data !== null): ?>

            <article>
                <center>
                <?php if ($data["image_file"]): ?>
                    <img src="http://localhost/students_management-app/uploads/<?= $data["image_file"]; ?>" alt="">
                <?php endif; ?>
                </center>

                <h2><?= htmlspecialchars($data["student_name"]); ?></h2> 
                <p><b>ID:</b> <?= htmlspecialchars($data["id"]); ?></p>
                <p>Email: <?= htmlspecialchars($data["email"]); ?>@lexischool.com</p>
                <p>Username: <?= htmlspecialchars($data["username"]);?></p>
                <p>Grade: <?= $data["grade"];?></p>
                <p>Class: <?= $data["class"];?></p>

                <form action="" method="POST">
                    <button id="pdf" type="submit" name="download">Download PDF</button>
                </form>

            </article>

            <p class="booking_link"><i>Click here to return to the <a href="http://localhost/students_management-app/index.php">website</a></i></p>
            
        
        <?php else: ?>
            <p>No data found.</p>
        <?php endif; ?>
    </div>
    
    
</body>
</html>