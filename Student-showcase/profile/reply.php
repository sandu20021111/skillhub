<?php
session_start();
include '../includes/db.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $message_id = intval($_POST['message_id']);
    $reply = trim($_POST['reply']);

    if ($reply !== '') {
        $stmt = $conn->prepare("UPDATE messages SET reply = ?, replied_at = NOW() WHERE id = ? AND receiver_id = ?");
        $stmt->bind_param("sii", $reply, $message_id, $_SESSION['user_id']);
        $stmt->execute();
    }
}

header('Location: messages.php');
exit();
