<?php
require_once('./database/database.php');


$id =($_GET['id']);
$profile = $_POST['image_url'];
$name = $_POST['name'];
$age = $_POST['age'];
$email = $_POST['email'];
$student = updateStudent($id,$profile,$name,$age,$email);


