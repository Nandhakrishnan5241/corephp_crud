<?php

include 'connect.php';
$sql = "SELECT * FROM tbl_details";
$result = $conn->query($sql);

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    

    if($result->num_rows > 0){
        foreach($result as $data){
            if ($username == $data['name'] && $password == $data['password']) {
                $_SESSION['user_id'] = 1;
                header('Location: dashboard.php');
                exit;
            } 
        }
            $error = "Invalid username or password.";
    }
    else{
        if ($username == 'admin' && $password == '1234') {
            $_SESSION['user_id'] = 1;
            header('Location: dashboard.php');
            exit;
        }
        else {
            $error = "Invalid username or password.";
        }
    }

    

    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
        }

        .login-container form {
            display: flex;
            flex-direction: column;
        }

        .login-container input {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 16px;
        }

        .login-container button {
            padding: 10px;
            background-color: #5cb85c;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        .login-container .links {
            text-align: center;
            margin-top: 10px;
        }

        .login-container .links a {
            margin: 0 10px;
            text-decoration: none;
            color: #007bff;
        }

        .login-container .error {
            color: red;
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="login-container">
        <h2>Login</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form action="" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>
        <div class="links">
       
            <a href="forgot_password.php">Forgot Password?</a>
        </div>
    </div>

</body>

</html>