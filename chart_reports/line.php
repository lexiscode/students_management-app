<?php

require "../includes/db_connect.php";
require "../includes/auth.php";

// Initialize the session.
session_start();

// NB: This below will no longer be necessary if you won't be displaying the new article link page for non-login users
if (!isLoggedIn()){
    
    die("Unauthorized. You must be logged in first." . PHP_EOL . "<a href='index.php'>Back To Homepage</a>");
}


// connect to the database server
$conn = connectDB();

/*
This SQL query selects the "student_class" column from the "students_record" table and uses 
the COUNT() function to calculate the number of students in each class. The result is grouped 
by the "student_class" column.
*/

$sql = "SELECT class, COUNT(*) AS total_students FROM students_record GROUP BY class";
$result = mysqli_query($conn, $sql);

$data = array();
while ($row = $result->fetch_assoc()) {
    $data[$row['class']] = $row['total_students'];
}

?>

<!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LEXISCHOOL</title>
    <link href="chart_style.css" rel="stylesheet" type="text/css">

    <!--Generate the HTML and JavaScript code for the bar graph using Chart.js-->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    
</head>

<body>

    <div class="head_container">
        <a href="http://localhost/students_management-app/index.php" style="text-decoration: none;"><h1 class="heading">LexiSchool Management System</h1></a>
    </div>

    <div class="graph-container">
        <canvas id="myChart"></canvas>
    </div>

    <script>
        var data = <?php echo json_encode($data); ?>;
        var labels = Object.keys(data);
        var values = Object.values(data);

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            data: {
                labels: labels,
                datasets: [{
                    type: 'line',
                    label: 'Number of Students',
                    data: values,
                    backgroundColor: 'rgba(75, 192, 192, 0.8)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        stepSize: 1,
                        grid: {
                            color: '#ccc'
                        },
                        ticks: {
                            font: {
                                family: 'Arial, sans-serif',
                                weight: 'bold'
                            }
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            font: {
                                family: 'Arial, sans-serif',
                                weight: 'bold'
                            }
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Number of Students by Classrooms',
                        font: {
                            family: 'Arial, sans-serif',
                            size: 18,
                            weight: 'bold'
                        },
                        padding: {
                            top: 20,
                            bottom: 10
                        }
                    }
                }
            }
        });
    </script>
</body>
</html>