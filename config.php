<?php
$host = 'localhost';
$db = 'cms_project';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

$logFile = __DIR__ . '/logs/actions.log';
function write_log($action, $email) {
    global $logFile;
    $time = date('Y-m-d H:i:s');
    $entry = "[$time] $action - $email" . PHP_EOL;
    file_put_contents($logFile, $entry, FILE_APPEND);
}
?>