<?php

use Dompdf\Dompdf;

require "includes/db_connect.php";
require "includes/get_student_data_id.php";
require 'vendor/autoload.php';

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


// Install Dompdf
//run this in bash: composer require dompdf/dompdf

ob_start(); // Start output buffering
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXISCHOOL</title>
    <link href="./stylings/student_data.css" rel="stylesheet">
</head>
<body>

    <h1><a href="http://localhost/students_management-app/index.php" style="text-decoration: none">LexiSchool Management System</a></h1>

    <div>
        <?php if ($data !== null): ?>

            <article>

                <?php if ($data["image_file"]): ?>
                    <img src="/uploads/<?= $data["image_file"]; ?>" alt="">
                <?php endif; ?>

                <h2><?= htmlspecialchars($data["student_name"]); ?></h2> 
                <p><b>ID:</b> <?= htmlspecialchars($data["id"]); ?></p>
                <p>Email: <?= htmlspecialchars($data["email"]); ?></p>
                <p>Username: <?= htmlspecialchars($data["username"]);?></p>
                <p>Grade: <?= $data["grade"];?></p>
                <p>Class: <?= $data["class"];?></p>

            </article>
            <p class="booking_link"><i>Click here to return to the <a href="http://localhost/flight_booking-app/index.php">website</a></i></p>

        <?php else: ?>
            <p>No data found.</p>
        <?php endif; ?>
    </div>
    
</body>
</html>


<?php

$html = ob_get_clean(); // Get the buffered output and clean the buffer

//Create a new Dompdf instance
$dompdf = new Dompdf();

// Load HTML contents
$dompdf->loadHtml($html);

// Set options, such as paper size, orientation, font, etc.
$dompdf->setPaper('A4', 'portrait');

// Render the PDF
$dompdf->render();

// Output the PDF to the browser
$dompdf->stream('course_form.pdf', ['Attachment' => false]);

?>