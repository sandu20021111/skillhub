<?php
session_start();
include '../includes/db.php';

$search = '';
if (isset($_GET['search'])) {
    $search = trim($_GET['search']);
}

if ($search !== '') {
    $like_search = '%' . $search . '%';
    $stmt = $conn->prepare("SELECT projects.id, projects.title, projects.description, users.name 
        FROM projects 
        JOIN users ON projects.user_id = users.id 
        WHERE projects.title LIKE ? OR projects.description LIKE ? OR users.name LIKE ?
        ORDER BY projects.created_at DESC");
    $stmt->bind_param("sss", $like_search, $like_search, $like_search);
} else {
    $stmt = $conn->prepare("SELECT projects.id, projects.title, projects.description, users.name 
        FROM projects 
        JOIN users ON projects.user_id = users.id 
        ORDER BY projects.created_at DESC");
}

$stmt->execute();
$result = $stmt->get_result();

$projects = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>All Student Projects</title>
  <link rel="stylesheet" href="../assets/css/all-projects.css" />
  <script src="../assets/js/script.js" defer></script>
</head>
<body>
 
  <div class="container">
    <button class="close-btn" onclick="goToHome()">×</button>
    <h1>All Student Projects</h1>

    <form method="get" action="" class="search-form">
      <input
        type="text"
        name="search"
        placeholder="Search projects by title, description, or creator"
        value="<?= htmlspecialchars($search) ?>"
      />
      <button type="submit">Search</button>
      <?php if ($search !== ''): ?>
        <a href="all-projects.php" class="clear-search">Clear</a>
      <?php endif; ?>
    </form>

    <div class="grid">
      <?php if (!empty($projects)): ?>
        <?php foreach ($projects as $project): ?>
          <div class="card">
            <h3><?= htmlspecialchars($project['title']) ?></h3>
            <p><?= htmlspecialchars(substr($project['description'], 0, 100)) ?>...</p>
            <p class="creator">By: <?= htmlspecialchars($project['name']) ?></p>
            <a href="project-details.php?id=<?= $project['id'] ?>" class="btn">View</a>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <p>No projects found.</p>
      <?php endif; ?>
    </div>
  </div>
    <script>
        function goToHome() {
            window.location.href = "/student-showcase/index.php";
        }
    </script>
</body>
</html>

