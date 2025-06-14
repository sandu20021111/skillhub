<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized. Please log in to comment.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'], $_POST['comment'])) {
    $user_id = $_SESSION['user_id'];
    $project_id = intval($_POST['project_id']);
    $comment = trim($_POST['comment']);

    if (!empty($comment)) {
        $stmt = $conn->prepare("INSERT INTO comments (user_id, project_id, comment) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $user_id, $project_id, $comment);
        $stmt->execute();
    }

    header("Location: project-details.php?id=" . $project_id);
    exit();
} else {
    echo "Invalid comment submission.";
}
