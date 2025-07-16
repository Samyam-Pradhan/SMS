<?php
session_start();
include 'config.php';

// Only allow admin
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php');
    exit();
}

$success = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name     = mysqli_real_escape_string($con, $_POST['name']);
    $roll     = mysqli_real_escape_string($con, $_POST['roll']);
    $class    = mysqli_real_escape_string($con, $_POST['class']);
    $email    = mysqli_real_escape_string($con, $_POST['email']);
    $phone    = mysqli_real_escape_string($con, $_POST['phone']);
    $gender   = mysqli_real_escape_string($con, $_POST['gender']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check if email or roll already exists
    $check = mysqli_query($con, "SELECT * FROM students WHERE email='$email' OR roll_no='$roll'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Student with this roll number or email already exists.";
    } else {
        $sql = "INSERT INTO students (name, roll_no, class, email, phone, gender, password)
                VALUES ('$name', '$roll', '$class', '$email', '$phone', '$gender', '$hashedPassword')";
        if (mysqli_query($con, $sql)) {
            $success = "Student added successfully.";
        } else {
            $error = "Error: " . mysqli_error($con);
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Student</title>
    <link rel="stylesheet" href="styles/add.css">
</head>
<body>
    <h2>Add New Student</h2>

    <?php if ($success) echo "<p style='color: green;'>$success</p>"; ?>
    <?php if ($error) echo "<p style='color: red;'>$error</p>"; ?>

    <form method="POST" action="">
        <label>Full Name:</label>
        <input type="text" name="name" required><br><br>

        <label>Roll No:</label>
        <input type="text" name="roll" required><br><br>

        <label>Class:</label>
        <input type="text" name="class" required><br><br>

        <label>Email:</label>
        <input type="email" name="email" required><br><br>

        <label>Phone:</label>
        <input type="text" name="phone" required><br><br>

        <label>Gender:</label>
        <select name="gender" required>
            <option value="">Select</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br><br>

        <label>Password:</label>
        <input type="password" name="password" required><br><br>

        <button type="submit">Add Student</button>
    </form>
    <a href="dashboard_admin.php" class="button-back">← Back to Dashboard</a>
   
</body>
</html>
