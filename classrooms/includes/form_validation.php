<?php

/**
 * Validate the input properties
 * 
 * @param string $student_class Student class, required
 * 
 * @return array An array of validation error messages
 */

// Using PHP 8 Match Expression below

function validateStudentData($student_class) {
    $errors = []; // Initialize $errors array
    
    return match('') {
        $student_class => [$errors[] = 'Student name field must not be empty'],
        default => $errors = []
    };
}


/*

function validateStudentData($student_class){
    
    $errors = [];

    if ($student_class == ''){
        $errors[] = 'This field must not be empty';
    }

    return $errors;
}
*/