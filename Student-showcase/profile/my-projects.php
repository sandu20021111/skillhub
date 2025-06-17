<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /student-showcase/auth/login.php");
    exit;
}

include '../includes/db.php';
$user_id = $_SESSION['user_id'];

if (isset($_GET['delete'])) {
    $del_id = intval($_GET['delete']);
    $stmt = $conn->prepare("DELETE FROM projects WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $del_id, $user_id);
    $stmt->execute();
    header("Location: my-projects.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM projects WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$projects = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Projects</title>
    <link rel="stylesheet" href="../assets/css/my-projects.css">
</head>
<body>
<div class="container">
    <button class="close-btn" onclick="goToHome()">×</button>
    <h2>My Projects</h2>
    <a href="add-edit-project.php" class="btn add">+ Add New Project</a><br>

    <?php if ($projects->num_rows > 0): ?>
        <div class="projects">
            <?php while ($row = $projects->fetch_assoc()): ?>
                <div class="project-card">
                    <h3><?= htmlspecialchars($row['title']) ?></h3>
                    <p><?= htmlspecialchars(substr($row['description'], 0, 100)) ?>...</p>
                    <div class="actions">
                        <a href="add-edit-project.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" class="btn delete" onclick="return confirm('Delete this project?')">Delete</a>
                        <a href="dashboard.php" class="btn back">Back</a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else: ?>
        <p>You haven’t added any projects yet.</p>
    <?php endif; ?>
</div>

<div id="popup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h3 id="popup-title"></h3>
        <p id="popup-desc"></p>
        <p><strong>Category:</strong> <span id="popup-cat"></span></p>
        <div id="popup-image"></div>
        <a id="popup-link" href="#" target="_blank">View GitHub/URL</a>
    </div>
</div>

<script>
        function goToHome() {
            window.location.href = "/student-showcase/profile/dashboard.php";
        }
    </script>


<script src="/assets/js/script.js"></script>
</body>
</html>
