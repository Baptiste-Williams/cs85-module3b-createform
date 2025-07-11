<?php
// Full Name: Baptiste Williams
// GitHub Repo: https://github.com/Baptiste-Williams/cs85-module3b-createform

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = htmlspecialchars($_POST['name']    ?? '');
    $email   = htmlspecialchars($_POST['email']   ?? '');
    $topic   = htmlspecialchars($_POST['topic']   ?? '');
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
        echo "<p>We received your message about: \"{$topic}\"</p>";
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
// ----- Output Predictions -----
// I expect to see a thank-you message with my name, the topic I entered, and my email.
// If I mess up the form (like leaving something blank), I should see  error messages.

// ----- Expected $_POST -----
// [
//   'name'    => 'Baptiste Williams',
//   'email'   => 'tc1028@hotmail.com',
//   'topic'   => 'Im just trying to see if this works; I hope so.',
//   'message' => 'A message that’s between 50 and 150 words long.',
//   'submit'  => 'Send Message'
// ]

// ----- Post-Test Reflections -----
// - Testing the form helped me understand how PHP handles form submissions step by step.
// - I saw how $_POST collects the data and how htmlspecialchars() protects against XSS.
// - I learned that str_word_count() doesn’t count numbers or symbols, so trimming the message first made a difference.
// - I realized how important it is to give users clear feedback when something goes wrong — like missing fields or short messages.
// - Seeing the thank-you message appear after a successful submission confirmed that my validation logic was working.
// - I also noticed that even if the browser said “404” earlier, the PHP still ran correctly once the file was in the right place.
// - Overall, testing made the whole process feel more real — I’m starting to see how I could use this in actual projects.

?>