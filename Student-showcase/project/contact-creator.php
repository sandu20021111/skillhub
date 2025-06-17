<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../auth.php");
    exit();
}

$sender_id = $_SESSION['user_id'];
$project_id = $_POST['project_id'];
$message = trim($_POST['message']);

$stmt = $conn->prepare("SELECT user_id FROM projects WHERE id = ?");
$stmt->bind_param("i", $project_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Invalid project.");
}
$row = $result->fetch_assoc();
$receiver_id = $row['user_id'];

$stmt = $conn->prepare("INSERT INTO messages (sender_id, receiver_id, project_id, message) VALUES (?, ?, ?, ?)");
$stmt->bind_param("iiis", $sender_id, $receiver_id, $project_id, $message);
$stmt->execute();

header("Location: ../profile/messages.php?success=1");
exit();
