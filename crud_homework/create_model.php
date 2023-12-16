<?php

require_once('database/database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Step 1: Receive Form Data
    $profile = $_POST['image_url'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $email = $_POST['email'];


    // Step 2: Validation and Sanitization (You can customize this based on your requirements)

    // Example: Check if required fields are not empty
    if (empty($profile) || empty($name) || empty($age) || empty($email)) {
        echo "All fields are required.";
        // You might want to redirect or display an error message here
        exit();
    }
    $data = [
        'profile' => $profile,
        'name' => $name,
        'age' =>  $age,
        'email' =>  $email
    ];
    createStudent($data);
    // Step 3: Insert Data into the Database

}
