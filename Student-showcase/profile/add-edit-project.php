<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: /student-showcase/auth/login.php");
    exit;
}

include '../includes/db.php';
$user_id = $_SESSION['user_id'];
$title = $description = $category = $github_url = "";
$update = false;
$image_path = "";

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $stmt = $conn->prepare("SELECT * FROM projects WHERE id = ? AND user_id = ?");
    $stmt->bind_param("ii", $id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        $project = $result->fetch_assoc();
        $title = $project['title'];
        $description = $project['description'];
        $category = $project['category'];
        $github_url = $project['github_url'];
        $image_path = $project['image_path'];
        $update = true;
    } else {
        header("Location: /student-showcase/profile/my-projects.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $github_url = trim($_POST['github_url']);
    $new_image_path = $image_path;

    if (!empty($_FILES['image']['name'])) {
        $uploadDir = '/uploads/';
        $uploadPath = $_SERVER['DOCUMENT_ROOT'] . $uploadDir;
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0777, true);
        }
        $filename = basename($_FILES['image']['name']);
        $target = $uploadPath . $filename;
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $new_image_path = $uploadDir . $filename;
    }

    if ($update) {
        $stmt = $conn->prepare("UPDATE projects SET title=?, description=?, category=?, github_url=?, image_path=? WHERE id=? AND user_id=?");
        $stmt->bind_param("ssssssi", $title, $description, $category, $github_url, $new_image_path, $id, $user_id);
    } else {
        $stmt = $conn->prepare("INSERT INTO projects (user_id, title, description, category, github_url, image_path) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssss", $user_id, $title, $description, $category, $github_url, $new_image_path);
    }

    $stmt->execute();
    header("Location: my-projects.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= $update ? 'Edit Project' : 'Add Project' ?></title>
    <link rel="stylesheet" href="../assets/css/add-edit-project.css">
</head>
<body>
<div class="form-container">
    <h2><?= $update ? 'Edit Project' : 'Add New Project' ?></h2>
    <form method="POST" enctype="multipart/form-data">
        <label>Title</label>
        <input type="text" name="title" required value="<?= htmlspecialchars($title) ?>">

        <label>Description</label>
        <textarea name="description" rows="4" required><?= htmlspecialchars($description) ?></textarea>

        <label>Category</label>
        <input type="text" name="category" required value="<?= htmlspecialchars($category) ?>">

        <label>GitHub / Document URL</label>
        <input type="text" name="github_url" value="<?= htmlspecialchars($github_url) ?>">

        <label>Image / File</label>
        <input type="file" name="image">
        <?php if ($image_path): ?>
            <p>Current File:</p>
            <img src="<?= $image_path ?>" alt="Current Project Image" width="100">
        <?php endif; ?>

        <button type="submit"><?= $update ? 'Update Project' : 'Add Project' ?></button>
    </form>
    <a class="back" href="my-projects.php">← Back to My Projects</a>
</div>
</body>
</html>
