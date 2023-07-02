# Student Records Management System

The Student Records Management System is a web application built using vanilla PHP and MySQL db storage. It allows you to manage student records, including adding new students, reading their information, updating their information, and deleting records; alongside their classroom information.


## Features

- Add new students with their full name, username, email, grade, classname, and an optional image upload.
- Displays the submitted information and grant a print out functionality.
- To access the administration page, login with official admin(s) username and password.
- In the admin page, view the list of students and their informations, have access to more functionalities such as possibility of deleting and updating information.
- In the admin page also, you can access reports based on numbers of students and their registered courses. You can as well have access to create/read/update/delete classes avaialable in the school.
- Added validations to form inputs and showing the messages properly

For the project demo, you can look at the video below:

https://github.com/lexiscode/students_management-app/assets/42210784/faa6d7e4-6527-4f5f-9722-def248191f3e

## Installation

1. Make sure you have PHP installed on your system.
2. Start the phpMyAdmin Apache and MySQL server in the from the xampp control, located in the xampp directory.
3. Clone the repository via HTTPS or SSH to your local machine.
4. Move the repo directory into xampp/htdocs directory.
5. Open the repository with your VS Code IDE (or any other IDEs).
6. Open a browser and go to URL http://localhost/phpmyadmin/
7. Then, click on the "Databases" tab.
8. Create a database naming “students_management_system” and then click on the "Import" tab.
9. Click on "browse file" and select “students_management_system.sql” file which is inside this project repo directory.
10. Click on "Go". 


## Usage

- Go to phpMyAdmin, click on the project's database created, then click on the "Privileges" tab
- Click on "Add user account" then fill in this login information below:
host_name: "localhost";
username: "lexischool_db";
password: "uZNxL5*_mhWmA8vP";
- Return back to your VSCode IDE and within the repo directory, install Dompdf library by running this command inside your bash terminal: "composer require dompdf/dompdf"
- Open a browser and go to URL http://localhost/students_management-app/
- Administration access login information
username: "lexischool";
password: "unlockme123"


## Technologies

- PHP: Server-side scripting language used for handling data and rendering views.
- MySQL: Database-based storage used to store the student records.
- CSS: Frontend styling language used to style an HTML document.
- Bootstrap: Front-end framework for responsive and modern user interface design.
- JavaScript: Powerful programming language that can add interactivity to a website.

## Contributing

Contributions are welcome! If you find any issues or have suggestions for improvements, please open an issue or submit a pull request.
