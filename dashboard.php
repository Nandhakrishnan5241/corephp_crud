
<?php
include 'connect.php';
$sql = "SELECT * FROM tbl_details";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div class="text-end" style="margin-top: 10px;">
            <a href="/corephp_crud/add.php" class="btn btn-primary">Add New User</a>
            <a href="/corephp_crud/logout.php" class="btn btn-danger">Logout</a>
        </div>
    </div>

    <div class="container mt-5">
    <h2 class="text-center mb-4">Users List</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>State</th>
                <th>City</th>
                <th>Address</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                $count = 1;
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $count . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['age'] . "</td>";
                    echo "<td>" . $row['dob'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>" . $row['state'] . "</td>";
                    echo "<td>" . $row['city'] . "</td>";
                    echo "<td>" . $row['address'] . "</td>";
                    echo "<td><img src='" . $row['image'] . "' alt='User Image' style='width: 100px; height: 100px;'></td>";

                    echo "<td>
                            <a href='/corephp_crud/edit.php?id=" . $row['id'] . "' class='btn btn-warning btn-sm'>Edit</a> 
                            <a href='/corephp_crud/delete.php?id=" . $row['id'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure?\")'>Delete</a>
                          </td>";
                    echo "</tr>";
                    $count++;
                }
            } else {
                echo "<tr><td colspan='9' class='text-center'>No records found</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

</body>
</html>

<?php
$conn->close();
?>