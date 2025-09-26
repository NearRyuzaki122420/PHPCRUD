<?php
include 'db_connect.php';

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: select.php");
    exit;
}

$sql = "SELECT * FROM students WHERE id = $id";
$result = $conn->query($sql);
$student = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $course = $_POST['course'];

    $sql = "UPDATE students SET name='$name', email='$email', course='$course' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        header("Location: select.php?msg=updated");
        exit;
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Student</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="card shadow-lg">
    <div class="card-header bg-warning text-dark">
      <h4 class="mb-0">✏ Edit Student</h4>
    </div>
    <div class="card-body">
      <form method="POST" action="">
        <div class="mb-3">
          <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" value="<?= htmlspecialchars($student['name']) ?>" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" value="<?= htmlspecialchars($student['email']) ?>" required>
        </div>

        <div class="mb-3">
          <label for="course" class="form-label">Course</label>
          <input type="text" class="form-control" id="course" name="course" value="<?= htmlspecialchars($student['course']) ?>" required>
        </div>

        <div class="d-flex justify-content-between">
          <a href="select.php" class="btn btn-secondary">⬅ Back</a>
          <button type="submit" class="btn btn-warning">💾 Update Student</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
