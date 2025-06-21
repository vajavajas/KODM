<?php
session_start();
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);

    if ($stmt->fetch()) {
        echo "Email already exists.";
    } else {
        $roleStmt = $pdo->prepare("SELECT id FROM roles WHERE role_name = 'user'");
        $roleStmt->execute();
        $roleId = $roleStmt->fetchColumn();

        $insert = $pdo->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
        if ($insert->execute([$name, $email, $password, $roleId])) {
            write_log("REGISTERED", $email);
            $_SESSION['success'] = "Registration successful!";
            header("Location: login.html");
            exit;
        } else {
            echo "Registration failed.";
        }
    }
}
?>
