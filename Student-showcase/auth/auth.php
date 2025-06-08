<?php
session_start(); 

$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "student_showcase"; 


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['register_submit'])) {
    $name = $_POST['reg_username'];
    $email = $_POST['reg_email'];
    $password = password_hash($_POST['reg_password'], PASSWORD_DEFAULT); 


    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Registration successful! Please login.";
        header("Location: auth.php"); 
        exit();
    } else {
        $_SESSION['error'] = "Error: " . $stmt->error;
    }
    $stmt->close();
}


if (isset($_POST['login_submit'])) {
    $email = $_POST['login_username']; 
    $password = $_POST['login_password'];


    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['user_name'] = $name;
            $_SESSION['message'] = "Login successful!";
            header("Location: /student-showcase/profile/dashboard.php"); 
            exit();
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "No user found with that email.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login & Register</title>
    <link rel="stylesheet" href="auth.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <div class="wrapper">
        <span class="bg-animate"></span>
        <span class="bg-animate2"></span>

        <div class="form-box login">
            <h2 class="animation" style="--i:0; --j:21">Login</h2>
            <form action="auth.php" method="POST">
                <div class="input-box animation" style="--i:1; --j:22">
                    <input type="text" name="login_username" required>
                    <label>Email</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:2; --j:23">
                    <input type="password" name="login_password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>
                <button type="submit" name="login_submit" class="btn animation" style="--i:3; --j:24">Login</button>
                <div class="logreg-link animation" style="--i:4; --j:25">
                    <p>Don't have an account? <a href="#" class="register-link">Sign Up</a></p>
                </div>
            </form>
        </div>
        <div class="info-text login">
            <h2 class="animation" style="--i:0; --j:20">Welcome Back!</h2>
            <p class="animation" style="--i:1; --j:21">Here is the best place to publish your skills!!</p>
        </div>

        <div class="form-box register">
            <h2 class="animation" style="--i:17; --j:0">Sign Up</h2>
            <form action="auth.php" method="POST">
                <div class="input-box animation" style="--i:18; --j:1">
                    <input type="text" name="reg_username" required>
                    <label>Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box animation" style="--i:19; --j:2">
                    <input type="email" name="reg_email" required>
                    <label>Email</label>
                    <i class='bx bx-envelope'></i>
                </div>
                <div class="input-box animation" style="--i:20; --j:3">
                    <input type="password" name="reg_password" required>
                    <label>Password</label>
                    <i class='bx bxs-lock'></i>
                </div>

                <button type="submit" name="register_submit" class="btn animation" style="--i:21; --j:4">SignUp</button>
                <div class="logreg-link animation" style="--i:22; --j:5">
                    <p>Already have an account? <a href="#" class="login-link">Login</a></p>
                </div>
            </form>
        </div>
        <div class="info-text register">
            <h2 class="animation" style="--i:17; --j:0">Welcome Back!</h2>
            <p class="animation" style="--i:18; --j:1">Here is the best place to publish your skills!!</p>
        </div>
    </div>

    <script src="auth.js"></script>
    <?php

    if (isset($_SESSION['message'])) {
        echo '<script>alert("' . $_SESSION['message'] . '");</script>';
        unset($_SESSION['message']); 
    }
    if (isset($_SESSION['error'])) {
        echo '<script>alert("' . $_SESSION['error'] . '");</script>';
        unset($_SESSION['error']); 
    }
    ?>
</body>

</html>