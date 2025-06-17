<?php
session_start();
$_SESSION = array();
session_destroy();

header("Location: /student-showcase/auth/auth.php");
exit;
?>
