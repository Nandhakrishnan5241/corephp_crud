<?php
include 'connect.php';
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "DELETE FROM tbl_details WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
