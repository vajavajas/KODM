<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.html");
    exit;
}
$user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html>
<head><title>Dashboard</title></head>
<body>
  <h2>Welcome, <?= htmlspecialchars($user['name']) ?>!</h2>
  <p>Email: <?= htmlspecialchars($user['email']) ?></p>
  <p>Role ID: <?= $user['role_id'] ?></p>
  <a href="logout.php">Logout</a>
</body>
</html>
