<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Contact Form</title>
</head>
<body>

<form action="" method="POST">
  <label for="name">Full Name:</label><br>
  <input type="text" id="name" name="name" required><br><br>

  <label for="email">Email Address:</label><br>
  <input type="email" id="email" name="email" required><br><br>

  <label for="topic">Topic of Message:</label><br>
  <input type="text" id="topic" name="topic" required><br><br>

  <label for="message">Message (50–150 words):</label><br>
  <textarea id="message" name="message" rows="6" cols="50" required></textarea><br><br>

  <input type="submit" name="submit" value="Send Message">
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $name = htmlspecialchars($_POST['name'] ?? '');
  $email = htmlspecialchars($_POST['email'] ?? '');
  $topic = htmlspecialchars($_POST['topic'] ?? '');
  $message = htmlspecialchars($_POST['message'] ?? '');

  $errors = [];

  if (trim($name) === '') {
    $errors[] = 'Full Name is required.';
  }
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = 'Please enter a valid email address.';
  }
  if (trim($topic) === '') {
    $errors[] = 'Topic of Message is required.';
  }
  $wordCount = str_word_count(trim($message));
  if ($wordCount < 50 || $wordCount > 150) {
    $errors[] = "Message must be between 50 and 150 words. You wrote {$wordCount}.";
  }

  if (empty($errors)) {
    echo "<h2>Thank you, {$name}!</h2>";
    echo "<p>We received your message about: \"{$topic}\" </p>";
    echo "<p>We'll get back to you at {$email}.</p>";
    exit;
  }

  echo '<ul style="color:red;">';
  foreach ($errors as $err) {
    echo "<li>{$err}</li>";
  }
  echo '</ul>';
}
?>
