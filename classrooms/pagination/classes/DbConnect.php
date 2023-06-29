<?php

/**
 * DbConnect
 * 
 * A connection to the database
 */
class DbConnect
{   
    /**
     * Get the database connection
     * 
     * @return PDO object Connection to the database server
     */
    public function getConn()
    {

        $db_host = "localhost";
        $db_name = "students_management_system";
        $db_user = "lexischool_db";
        $db_passwd = "uZNxL5*_mhWmA8vP";

        $dsn = 'mysql:host='.$db_host. ';dbname='.$db_name.';charset=utf8';
        
        $conn = new PDO($dsn, $db_user, $db_passwd);

        // Error handling for the database connection
        try {

            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;

        } catch (PDOException $e) {
            
            echo $e->getMessage();
            exit;
        }

    
    }
}