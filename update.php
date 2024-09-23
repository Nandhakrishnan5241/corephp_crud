<?php
include 'connect.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id  = $_POST['id'];
    $name     = $_POST['name'];
    $dob      = $_POST['dob'];
    $email    = $_POST['email'];
    $password   = $_POST['password'];
    $mobile   = $_POST['mobile'];
    $address  = $_POST['address'];
    $state    = $_POST['state'];
    $city     = $_POST['city'];
    $old_image     = $_POST['old_image'];

    if (!empty($dob)) {
        $dobDateTime = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($dobDateTime)->y; 
    } else {
        $age = null; 
    }

    if (!empty($_FILES['user_image']['name'])) {
        $target_dir = "uploads/";
        $image = $target_dir . basename($_FILES["user_image"]["name"]);
        move_uploaded_file($_FILES["user_image"]["tmp_name"], $image);
    } else {
        $image = $old_image;
    }

    $sql = "UPDATE tbl_details SET name = ?, age = ?, dob = ?, email = ?, password = ?, mobile = ?, address = ?, state = ?, city = ?, image = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssi", $name, $age, $dob, $email, $password, $mobile, $address, $state, $city, $image, $user_id);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
    } else {
        echo "Error updating record: " . $stmt->error;
    }

    $stmt->close();
}
