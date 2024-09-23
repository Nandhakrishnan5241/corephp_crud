<?php
include 'connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name       = $_POST['name'];
    $dob        = $_POST['dob'];
    $email      = $_POST['email'];
    $password   = $_POST['password'];
    $mobile     = $_POST['mobile'];
    $address    = $_POST['address'];
    $state      = $_POST['state'];
    $city       = $_POST['city'];

    if (!empty($dob)) {
        $dobDateTime = new DateTime($dob);
        $today       = new DateTime();
        $age         = $today->diff($dobDateTime)->y; 
    } else {
        $age = null; 
    }

    $user_image = '';
    if (isset($_FILES['user_image']) && $_FILES['user_image']['error'] == 0) {
        $image_path = 'uploads/' . basename($_FILES['user_image']['name']);
        move_uploaded_file($_FILES['user_image']['tmp_name'], $image_path);
        $user_image = $image_path;
    }

    $sql = "INSERT INTO tbl_details (name, age, dob, email, password, mobile, address, image, state, city) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Prepare failed: " . $conn->error);
    }
    $dobFormatted = $dobDateTime->format('Y-m-d'); 

   
    $stmt->bind_param("ssssssssss", $name, $age, $dobFormatted, $email, $password, $mobile, $address, $user_image, $state, $city);

    
    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
