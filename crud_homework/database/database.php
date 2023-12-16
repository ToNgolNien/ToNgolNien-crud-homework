<?php

/**
 * Connect to database
 **/

function db()
{
    $servername = "localhost";
    $username = "root";
    $password = "";
    $databaseName = 'web_a';
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$databaseName", $username, $password);
        // set the PDO error mode to exception

        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // echo "Connected successfully";
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
    return $conn;
}

/**
 * Create new student record
 */

function createStudent($values)
{
    $conn = db();

    $sttm = $conn->prepare('INSERT INTO student (profile, name, age, email) VALUES (:profile, :name, :age, :email)');
    $sttm->bindParam(':profile', $values['profile']);
    $sttm->bindParam(':name', $values['name']);
    $sttm->bindParam(':age', $values['age']);
    $sttm->bindParam(':email', $values['email']);

    // Execute the statement
    if ($sttm->execute()) {
        echo "Thêm thành công";
    } else {
        echo "Error inserting record: " . $sttm->errorInfo()[2];
    }
}


/**
 * Get all data from table student
 */
function selectAllStudents()
{
    $conn = db();
    $sttm = $conn->prepare('SELECT* FROM student');
    $sttm->execute();
    return $sttm->fetchAll(PDO::FETCH_ASSOC);
}

/** 
 * Get only one on record by id 
 */
function selectOnestudent($id)
{
    $conn = db();
    $sttm = $conn->prepare("SELECT* FROM student WHERE id= $id");
    $sttm->execute();
    return $sttm->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * Delete student by id
 */
function deleteStudent($id)
{
    $conn = db();
    $sttm = $conn->prepare('DELETE FROM student WHERE id = :id');
    $sttm->bindParam(':id', $id);
    if ($sttm->execute()) {
        echo "xóa thành công ";
    } else {
        echo "Error inserting record: " . $sttm->errorInfo()[2];
    }
}


/**
 * Update students
 * 
 */
function updateStudent($id, $profile, $name, $age, $email)
{

    $conn = db();
    $sttm = $conn->prepare("UPDATE student SET profile = :profile, name = :name, age = :age, email= :email WHERE id = :id");
    $sttm->bindParam(':id', $id);
    $sttm->bindParam(':profile', $profile);
    $sttm->bindParam(':name', $name);
    $sttm->bindParam(':age', $age);
    $sttm->bindParam(':email', $email);

    if ($sttm->execute()) {
        echo "Cập nhập thành công";
    } else {
        echo "Error updating record: " . $sttm->errorInfo()[2];
    }
}
