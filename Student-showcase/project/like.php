<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    die("Unauthorized. Please log in to like a project.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['project_id'])) {
    $user_id = $_SESSION['user_id'];
    $project_id = intval($_POST['project_id']);

    $check = $conn->prepare("SELECT id FROM likes WHERE user_id = ? AND project_id = ?");
    $check->bind_param("ii", $user_id, $project_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows === 0) {
        $stmt = $conn->prepare("INSERT INTO likes (user_id, project_id) VALUES (?, ?)");
        $stmt->bind_param("ii", $user_id, $project_id);
        $stmt->execute();
    } else {
        $delete = $conn->prepare("DELETE FROM likes WHERE user_id = ? AND project_id = ?");
        $delete->bind_param("ii", $user_id, $project_id);
        $delete->execute();
    }

    header("Location: project-details.php?id=" . $project_id);
    exit();
} else {
    echo "Invalid request.";
}
