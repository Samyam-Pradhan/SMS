<?php
session_start();
include 'config.php';

// Only allow access if admin is logged in
if (!isset($_SESSION['admin'])) {
    header('Location: login_admin.php');
    exit();
}

// Fetch all students from the database
$result = mysqli_query($con, "SELECT * FROM students ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Students</title>
    <link rel="stylesheet" href="styles/view.css">
</head>
<body>

<h2>All Student data</h2>

<?php if (mysqli_num_rows($result) > 0): ?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll No</th>
            <th>Class</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Gender</th>
            <th>Created At</th>
        </tr>
        <?php while ($student = mysqli_fetch_assoc($result)): ?>
            <tr>
                <td><?= $student['id'] ?></td>
                <td><?= htmlspecialchars($student['name']) ?></td>
                <td><?= htmlspecialchars($student['roll_no']) ?></td>
                <td><?= htmlspecialchars($student['class']) ?></td>
                <td><?= htmlspecialchars($student['email']) ?></td>
                <td><?= htmlspecialchars($student['phone']) ?></td>
                <td><?= htmlspecialchars($student['gender']) ?></td>
                <td><?= $student['created_at'] ?></td>
            </tr>
        <?php endwhile; ?>
    </table>
<?php else: ?>
    <p>No students found.</p>
<?php endif; ?>
<a href="dashboard_admin.php" class="button-back">← Back to Dashboard</a>
</body>
</html>
