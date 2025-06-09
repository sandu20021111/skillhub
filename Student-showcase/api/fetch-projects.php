<?php
// api/fetch-projects.php
header('Content-Type: application/json');
include '../includes/db.php';

$sql = "SELECT projects.id, projects.title, projects.description, projects.image_path, users.name 
        FROM projects 
        JOIN users ON projects.user_id = users.id 
        ORDER BY projects.created_at DESC";

$result = $conn->query($sql);

$projects = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $projects[] = $row;
    }
}

echo json_encode($projects);
