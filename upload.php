<?php
$uploadDir = "uploads/";
$message = "";

if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0755, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['sampleFile'])) {
    $file = $_FILES['sampleFile'];
    $filename = basename($file['name']);
    $targetPath = $uploadDir . $filename;

    if ($file['error'] === 0) {
        if (move_uploaded_file($file['tmp_name'], $targetPath)) {
            $message = "<p style='color: #0f0;'>✅ File <strong>$filename</strong> uploaded successfully.</p>";
        } else {
            $message = "<p style='color: red;'>❌ Failed to save the uploaded file.</p>";
        }
    } else {
        $message = "<p style='color: orange;'>⚠️ Upload error: " . $file['error'] . "</p>";
    }
} else {
    $message = "<p style='color: red;'>❌ Invalid request.</p>";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Upload Result</title>
  <link rel="stylesheet" href="sample.css" />
</head>
<body>
  <header>
    <div class="logo-container">
      <img src="3f21445e-69e0-42cf-87a5-3f76e293d34d.png" alt="KODM Logo" class="logo-img" />
    </div>
    <nav class="navigation">
      <a href="index.html">Home</a>
      <a href="aboutus.html">About us</a>
      <a href="contact.html">Contact</a>
      <a href="subs.html">Subscriptions</a>
      <a href="samples.html">Samples</a>
      <a href="login.html"><button class="login-popup">Login</button></a>
    </nav>
  </header>

  <main class="upload-section">
    <div class="upload-result-card">
      <h2>Upload Result</h2>
      <?= $message ?>
      <br><br>
      <a href="samples.html" class="submit-btn">⬅ Back to Samples</a>
    </div>
  </main>
</body>
</html>