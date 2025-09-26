<?php
include 'db_connect.php';

// Show success/error messages from redirects
$msg = "";
if (isset($_GET['msg'])) {
    if ($_GET['msg'] == "added") {
        $msg = '<div class="alert alert-success">✅ Student added successfully!</div>';
    } elseif ($_GET['msg'] == "updated") {
        $msg = '<div class="alert alert-warning">✏ Student updated successfully!</div>';
    } elseif ($_GET['msg'] == "deleted") {
        $msg = '<div class="alert alert-danger">🗑 Student deleted successfully!</div>';
    }
}

$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Student Records</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="text-primary">📚 Student Records</h2>
    <a href="insert.php" class="btn btn-success">➕ Add Student</a>
  </div>

  <!-- Show alert message -->
  <?= $msg ?>

  <div class="card shadow-sm">
    <div class="card-body">
      <table class="table table-hover table-bordered text-center">
        <thead class="table-dark">
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Course</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
              <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['name']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['course']) ?></td>
                <td>
                  <a href="update.php?id=<?= $row['id'] ?>" class="btn btn-warning btn-sm">✏ Edit</a>
                  <a href="delete.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">🗑 Delete</a>
                </td>
              </tr>
            <?php endwhile; ?>
          <?php else: ?>
            <tr>
              <td colspan="5" class="text-muted">No records found. Add a student first.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
