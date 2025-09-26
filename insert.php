<?php
include 'db_connect.php';

$message = ""; // for showing alerts

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = trim($_POST['name']);
    $email  = trim($_POST['email']);
    $course = trim($_POST['course']);

    if (!empty($name) && !empty($email) && !empty($course)) {
        $sql = "INSERT INTO students (name, email, course) VALUES ('$name', '$email', '$course')";
        if ($conn->query($sql) === TRUE) {
            $message = '<div class="alert alert-success">✅ Student added successfully!</div>';
        } else {
            $message = '<div class="alert alert-danger">❌ Error: ' . $conn->error . '</div>';
        }
    } else {
        $message = '<div class="alert alert-warning">⚠ Please fill in all fields.</div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="card shadow-lg">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">➕ Add New Student</h4>
    </div>
    <div class="card-body">

      <!-- Show alert messages -->
      <?= $message ?>

      <form method="POST" action="insert.php">
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" required placeholder="Enter full name">
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" required placeholder="Enter email">
        </div>

        <div class="mb-3">
          <label for="course" class="form-label">Course</label>
          <input type="text" class="form-control" id="course" name="course" required placeholder="Enter course">
        </div>

        <div class="d-flex justify-content-between">
          <a href="select.php" class="btn btn-secondary">⬅ Back</a>
          <button type="submit" class="btn btn-success">✅ Save Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
