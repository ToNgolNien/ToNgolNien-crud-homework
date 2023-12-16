<?php

/**
 * Connect to database
 */
/**
 * PDO::FETCH_ASSOC: trả về dữ liệu dạng mảng với key là tên cột của bảng trong CSDL.
 */

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
    //Prepared Statement để tránh bị tấn công SQL Injection.
    ////Khởi tạo Prepared Statement
    $sttm = $conn->prepare('INSERT INTO student (profile, name, age, email) VALUES (:profile, :name, :age, :email)');
    //bindParam($tên_place_holder, $giá_trị_của_place_holder)
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
    //PDO::FETCH_ASSOC: Trả về dữ liệu dạng mảng với key là tên của column (column của các table trong database)
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
    // Sử dụng prepared statement để tránh SQL injection
    $sttm = $conn->prepare("UPDATE student SET profile = :profile, name = :name, age = :age, email= :email WHERE id = :id");
    $sttm->bindParam(':id', $id);
    $sttm->bindParam(':profile', $profile);
    $sttm->bindParam(':name', $name);
    $sttm->bindParam(':age', $age);
    $sttm->bindParam(':email', $email);

    // Thực hiện truy vấn cập nhật
    if ($sttm->execute()) {
        echo "Cập nhập thành công";
    } else {
        echo "Error updating record: " . $sttm->errorInfo()[2];
    }
}
