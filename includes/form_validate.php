<?php

/**
 * Validate the input properties
 * 
 * @param string $student_name Student Name, required
 * @param string $username Username, required
 * @param string $email Email, required
 * @param string $grade Grade, required
 * @param string $class Class, required
 * 
 * @return array An array of validation error messages
 */


function validateForm($student_name, $username, $email, $grade, $class){
    
    $errors = [];

    if ($student_name == ''){
        $errors[] = 'Student name field must not be empty';
    }
    if ($username == ''){
        $errors[] = 'Username field must not be empty';
    }
    if ($email == ''){
        $errors[] = 'Email field must not be empty';
    }
    if ($grade == ''){
        $errors[] = 'Grade field must not be empty';
    }
    if ($class == ''){
        $errors[] = 'Class field must not be empty';
    }

    return $errors;
}


/* Using PHP 8 Match Expression below

function validateForm($student_name, $username, $email, $grade, $class){
    
    return match('') {
        $student_name => [$errors[] = 'Student name field must not be empty'],
        $username => [$errors[] = 'Username field must not be empty'],
        $email => [$errors[] = 'Email field must not be empty'],
        $grade => [$errors[] = 'Grade field must not be empty'],
        $class => [$errors[] = 'Class field must not be empty'],
        default => $errors = []
    };
}

NB: I noticed a limitation when using this, which is why I chose not to use it. For instance, if two fields
are left empty, it only drops validation warning to one of the field instead of both together. And that's
not my desire :)
*/