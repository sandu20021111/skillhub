<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location:/student-showcase/auth/login.php");
    exit;
}
include '../includes/db.php';

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $bio = trim($_POST['bio']);

    if (!empty($_FILES['profile_pic']['name'])) {
        $img_name = basename($_FILES['profile_pic']['name']);
        $target = "../uploads/profile/" . $img_name;
        move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target);
        $sql = "UPDATE users SET name=?, email=?, bio=?, profile_pic=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssi", $name, $email, $bio, $target, $user_id);
    } else {
        $sql = "UPDATE users SET name=?, email=?, bio=? WHERE id=?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssi", $name, $email, $bio, $user_id);
    }

    $stmt->execute();
    header("Location: dashboard.php");
    exit;
}

$stmt = $conn->prepare("SELECT name, email, bio, profile_pic FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../assets/css/edit-profile.css">
</head>
<body>
<div class="form-container">
    <h2>Edit Profile</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label>Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required>

        <label>Email:</label>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>

        <label>Bio:</label>
        <textarea name="bio" rows="4"><?= htmlspecialchars($user['bio']) ?></textarea>

        <label>Profile Picture:</label>
        <input type="file" name="profile_pic" accept="image/*">
        <?php if ($user['profile_pic']) : ?>
            <img src="<?= $user['profile_pic'] ?>" width="100" alt="Current Picture">
        <?php endif; ?>

        <button type="submit">Update Profile</button>
        <a href="dashboard.php" class="back">← Back to Dashboard</a>
    </form>
</div>
</body>
</html>
