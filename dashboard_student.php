<?php
session_start();
include 'config.php';

// Only allow if student is logged in
if (!isset($_SESSION['student_id'])) {
    header('Location: login_student.php');
    exit();
}

// Get student ID from session
$studentId = $_SESSION['student_id'];

// Fetch student data
$query = "SELECT * FROM students WHERE id = $studentId LIMIT 1";
$result = mysqli_query($con, $query);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles/students.css">
</head>
<body>

<h2>Welcome, <?= htmlspecialchars($student['name']) ?></h2>

<div class="profile-box">
    <h2>Your Profile</h2>
    <p><strong>Roll No:</strong> <?= htmlspecialchars($student['roll_no']) ?></p>
    <p><strong>Class:</strong> <?= htmlspecialchars($student['class']) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($student['email']) ?></p>
    <p><strong>Phone:</strong> <?= htmlspecialchars($student['phone']) ?></p>
    <p><strong>Gender:</strong> <?= htmlspecialchars($student['gender']) ?></p>
    <p><strong>Joined:</strong> <?= $student['created_at'] ?></p>
</div>

<br>
<a href="logout.php" class="logout-btn">Logout</a>

</body>
</html>
