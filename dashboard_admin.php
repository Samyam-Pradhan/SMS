<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php');
    exit();
}
?>

<head>
    <link rel="stylesheet" href="styles/admin.css">
</head>
<h2>Admin Dashboard</h2>
<p>Welcome, <?= $_SESSION['admin'] ?> </p>
<a href="add-student.php">Add Student</a> |
<a href="view-students.php">View All Students</a> |
<a href="logout.php">Logout</a>
