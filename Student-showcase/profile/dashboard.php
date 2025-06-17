<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /profile/dashboard.php");
    exit;
}


include '../includes/db.php';

$user_id = $_SESSION['user_id'];
$sql = "SELECT name, email, bio, profile_pic FROM users WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Dashboard</title>
    <link rel="stylesheet" href="../assets/css/dashboard.css">
</head>
<body>
    <div class="dashboard-container">
        <button class="close-btn" onclick="goToHome()">×</button>
        <h1>Welcome, <?= htmlspecialchars($user['name']) ?>!</h1>
        <div class="profile-card">
            <img src="<?= $user['profile_pic'] ?: '/assets/img/pet1.png' ?>" alt="">
            <div class="info">
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Bio:</strong> <?= nl2br(htmlspecialchars($user['bio'])) ?></p>
                <a href="edit-profile.php" class="btn">Edit Profile</a>
            </div>
        </div>

        <div class="actions">
            <a href="my-projects.php" class="btn">My Projects</a>
            <a href="messages.php" class="btn">Inbox</a>
            <a href="/student-showcase/auth/logout.php" class="btn logout">Logout</a>
        </div>
    </div>

    <script>
        function goToHome() {
            window.location.href = "/student-showcase/index.php"; 
        }
    </script>

    
    <script src="/assets/js/script.js"></script>
</body>
</html>
