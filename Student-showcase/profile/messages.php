<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/auth.php');
    exit();
}

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("SELECT m.id, m.message, m.reply, m.created_at, u.name AS sender_name 
                        FROM messages m 
                        JOIN users u ON m.sender_id = u.id 
                        WHERE m.receiver_id = ? 
                        ORDER BY m.created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$messages = [];
while ($row = $result->fetch_assoc()) {
    $messages[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <button class="close-btn" onclick="goToHome()">×</button>
  <meta charset="UTF-8">
  <title>Your Messages</title>
  <link rel="stylesheet" href="../assets/css/messages.css">
</head>
<body>
  <div class="container">
    <h1>Inbox</h1>
    <a href="dashboard.php" class="btn back">Back to Dashboard</a>

    <?php if (!empty($messages)): ?>
      <?php foreach ($messages as $msg): ?>
        <div class="message-card">
          <p><strong>From:</strong> <?= htmlspecialchars($msg['sender_name']) ?></p>
          <p><strong>Message:</strong> <?= nl2br(htmlspecialchars($msg['message'])) ?></p>
          <p><strong>Sent at:</strong> <?= $msg['created_at'] ?></p><br>

          <?php if ($msg['reply']): ?>
            <p class="reply"><strong>Your Reply:</strong> <?= nl2br(htmlspecialchars($msg['reply'])) ?></p>
          <?php else: ?>
            <form action="reply.php" method="POST" class="reply-form">
              <input type="hidden" name="message_id" value="<?= $msg['id'] ?>">
              <textarea name="reply" placeholder="Write your reply..." required></textarea>
              <button type="submit">Send Reply</button>
            </form>
          <?php endif; ?>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No messages yet.</p>
    <?php endif; ?>
  </div>
  <script>
        function goToHome() {
            window.location.href = "/student-showcase/profile/dashboard.php"; 
        }
    </script>

</body>
</html>
