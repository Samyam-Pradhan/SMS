<?php
session_start();
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $query = "SELECT * FROM students WHERE email='$email'";
    $result = mysqli_query($con, $query);  //

    if ($result && mysqli_num_rows($result) == 1) {
        $students = mysqli_fetch_assoc($result);

        if (password_verify($pass, $students['password'])) {
            $_SESSION['student_id'] = $students['id'];
            header('Location: dashboard_student.php');
            exit();
        } else {
            $error = "Incorrect password.";
        }
    }
}
?>
<head>
    <link rel="stylesheet" href="styles/login.css">
</head>
<form method="POST">
    <h2>Studnet Login</h2>

    <?php 
        if (isset($error)) echo "<p style='color:red;'>$error</p>"; 
    ?>
    
    Email: <input type="email" name="email" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>
