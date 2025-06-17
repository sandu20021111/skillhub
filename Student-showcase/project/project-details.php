<?php 
session_start();
include '../includes/db.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid project ID.");
}

$project_id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT p.title, p.description, u.name, u.email, p.github_url, p.file_path 
                        FROM projects p 
                        JOIN users u ON p.user_id = u.id 
                        WHERE p.id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Project not found.");
}

$project = $result->fetch_assoc();

$comments = [];
$commentStmt = $conn->prepare("SELECT c.comment, c.created_at, u.name 
                               FROM comments c 
                               JOIN users u ON c.user_id = u.id 
                               WHERE c.project_id = ? 
                               ORDER BY c.created_at DESC");
$commentStmt->bind_param("i", $project_id);
$commentStmt->execute();
$commentResult = $commentStmt->get_result();

while ($row = $commentResult->fetch_assoc()) {
    $comments[] = $row;
}

$likeStmt = $conn->prepare("SELECT COUNT(*) AS total_likes FROM likes WHERE project_id = ?");
$likeStmt->bind_param("i", $project_id);
$likeStmt->execute();
$likeResult = $likeStmt->get_result();
$likeCount = $likeResult->fetch_assoc()['total_likes'] ?? 0;

$commentCount = count($comments);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title><?= htmlspecialchars($project['title']) ?></title>
  <link rel="stylesheet" href="../assets/css/project-details.css" />
  <script src="../assets/js/script.js" defer></script>
</head>
<body>
  <div class="container">
    <h1><?= htmlspecialchars($project['title']) ?></h1>
    <p class="creator">By: <?= htmlspecialchars($project['name']) ?></p>
    <p class="description"><?= nl2br(htmlspecialchars($project['description'])) ?></p>

    <?php if (!empty($project['github_url'])): ?>
      <div class="project-link">
        <h3>Project GitHub Repository</h3>
        <p><a href="<?= htmlspecialchars($project['github_url']) ?>" target="_blank" rel="noopener noreferrer"><?= htmlspecialchars($project['github_url']) ?></a></p>
      </div>
    <?php endif; ?>

    <?php if (!empty($project['file_path'])): ?>
      <div class="project-document">
        <h3>Project Document</h3>
        <p><a href="<?= htmlspecialchars($project['file_path']) ?>" download>Download Project File</a></p>
      </div>
    <?php endif; ?>

    <div class="actions">
      <form action="like.php" method="POST">
        <input type="hidden" name="project_id" value="<?= $project_id ?>" />
        <button type="submit" class="like-btn">👍 Like</button>
      </form>

      <p>👍 Likes: <?= $likeCount ?></p>
      <p>💬 Comments: <?= $commentCount ?></p>

      <?php if (isset($_SESSION['user_id'])): ?>
        <button id="openContactBtn" class="btn">📧 Contact Creator</button>

        <div id="contactModal" class="modal" aria-hidden="true" role="dialog" aria-labelledby="contactModalTitle" aria-modal="true">
          <div class="modal-content">
            <span class="close-btn" id="closeContactBtn" role="button" aria-label="Close contact form">&times;</span>
            <h3 id="contactModalTitle">Contact the Creator</h3>
            <form action="contact-creator.php" method="POST" class="contact-form">
              <input type="hidden" name="project_id" value="<?= $project_id ?>" />
              <textarea name="message" placeholder="Write your message..." required></textarea>
              <button type="submit">Send Message</button>
            </form>
          </div>
        </div>
      <?php else: ?>
        <p><a href="../auth.php">Log in</a> to contact the creator.</p>
      <?php endif; ?>
    </div>

    <div class="comments-section">
      <h3>Comments</h3>
      <?php if (isset($_SESSION['user_id'])): ?>
        <form action="comment.php" method="POST" class="comment-form">
          <input type="hidden" name="project_id" value="<?= $project_id ?>" />
          <textarea name="comment" placeholder="Leave a comment..." required></textarea>
          <button type="submit">Submit</button>
        </form>
      <?php else: ?>
        <p><a href="../auth.php">Log in</a> to comment.</p>
      <?php endif; ?>

      <?php if (!empty($comments)): ?>
        <ul class="comment-list">
          <?php foreach ($comments as $c): ?>
            <li>
              <strong><?= htmlspecialchars($c['name']) ?>:</strong>
              <?= htmlspecialchars($c['comment']) ?>
              <small>(<?= $c['created_at'] ?>)</small>
            </li>
          <?php endforeach; ?>
        </ul>
      <?php else: ?>
        <p>No comments yet.</p>
      <?php endif; ?>
    </div>
  </div>
  <script src="/assets/js/script.js"></script>
</body>
</html>
