$host = "localhost";
$user = "root";
$pass = "";
$db = "resume_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM resumes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <title>All Resumes</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>
<body class="p-5">

  <h2>Submitted Resumes</h2>

  <?php if ($result->num_rows > 0): ?>
    <table class="table table-bordered mt-4">
      <thead class="table-light">
        <tr>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Education</th>
          <th>Experience</th>
          <th>Skills</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?= htmlspecialchars($row['name']) ?></td>
          <td><?= htmlspecialchars($row['email']) ?></td>
          <td><?= htmlspecialchars($row['phone']) ?></td>
          <td><?= nl2br(htmlspecialchars($row['education'])) ?></td>
          <td><?= nl2br(htmlspecialchars($row['experience'])) ?></td>
          <td><?= nl2br(htmlspecialchars($row['skills'])) ?></td>
          <td>
            <form action="delete_resume.php" method="post" onsubmit="return confirm('Delete this resume?');">
              <input type="hidden" name="id" value="<?= $row['id'] ?>">
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
            </form>
          </td>
        </tr>
        <?php endwhile; ?>
      </tbody>
    </table>
  <?php else: ?>
    <p class="mt-3">No resumes found.</p>
  <?php endif; ?>

  <a href="submit_resume.php" class="btn btn-secondary mt-3">Back to Submit Form</a>

  <?php $conn->close(); ?>
</body>
</html>