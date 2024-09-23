<?php
include 'connect.php';
if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $sql = "SELECT * FROM tbl_details WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Edit User</h2>
        <form action="/corephp_crud/update.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" id="id" name="id" value="<?php echo $user['id']; ?>">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $user['name']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="user_image" class="form-label">User Image</label>
                    <input type="file" class="form-control" id="user_image" name="user_image" value="<?php echo $user['image']; ?>">
                    <?php if (!empty($user['image'])): ?>
                        <p>Current Image: <img src="<?php echo $user['image']; ?>" alt="User Image" style="width: 100px; height: 100px;"></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="dob" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="<?php echo $user['dob']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $user['email']; ?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" value="<?php echo $user['password']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mobile" class="form-label">Mobile</label>
                    <input type="tel" class="form-control" id="mobile" name="mobile" value="<?php echo $user['mobile']; ?>" required>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="state" class="form-label">State</label>
                    <input type="text" class="form-control" id="state" name="state" value="<?php echo $user['state']; ?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="city" class="form-label">City</label>
                    <input type="text" class="form-control" id="city" name="city" value="<?php echo $user['city']; ?>" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <textarea class="form-control" id="address" name="address" required><?php echo $user['address']; ?></textarea>
            </div>

            <input type="hidden" id="old_image" name="old_image" value="<?php echo $user['image']; ?>">
            <div class="d-grid gap-2 col-4 mx-auto">
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

</body>

</html>