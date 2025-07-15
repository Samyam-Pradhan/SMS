<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM admin WHERE email='$email'";
    $result = mysqli_query($con, $query);  //

    if ($result && mysqli_num_rows($result) == 1) {
        $admin = mysqli_fetch_assoc($result);

        if (password_verify($pass, $admin['password'])) {
            $_SESSION['admin'] = $admin['email'];
            header('Location: dashboard_admin.php');
            exit();
        } else {
            $error = "Incorrect password.";
        }
    } else {
        $error = "Admin not found.";
    }
}
?>
<head>
    <link rel="stylesheet" href="styles/login.css">
</head>
<form method="POST">
    <h2>Admin Login</h2>

    <?php 
        if (isset($error)) echo "<p style='color:red;'>$error</p>"; 
    ?>
    
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
