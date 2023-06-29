<?php

/**
 * Get records from the database
 * 
 * A piece of writing for publication
 */
class GetAll
{

    /**
     * Get a page of article
     * 
     * @param object $conn Connection to the database
     * @param integer $limit Number of records to return
     * @param integer $offset Number of records to skip starting
     */
    public static function getPage($conn, $limit, $offset)
    {
        $sql = "SELECT * 
                FROM students_record 
                ORDER BY id ASC
                LIMIT :limit
                OFFSET :offset";

        $stmt = $conn->prepare($sql);

        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    /**
     * Get a count of the total number of records
     * 
     * @param object $conn Connection to the database
     * 
     * @param integer The total number of records 
     */
    public static function getTotalRecords($conn)
    {
        return $conn->query('SELECT COUNT(*) FROM students_record')->fetchColumn();
    }
    
}