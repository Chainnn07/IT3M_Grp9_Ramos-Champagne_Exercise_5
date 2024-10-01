<?php
// submit_feedback.php

// Set the file path for storing feedback
$file_path = 'feedback.txt';

// Get the feedback data from the POST request
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Prepare the feedback entry
$feedback_entry = "Name: " . htmlspecialchars($name) . "\n" .
                  "Email: " . htmlspecialchars($email) . "\n" .
                  "Message: " . htmlspecialchars($message) . "\n" .
                  "--------------------\n";

// Write the feedback to the file
if (file_put_contents($file_path, $feedback_entry, FILE_APPEND | LOCK_EX) !== false) {
    echo "Feedback submitted successfully!";
} else {
    echo "Error writing feedback. Please try again.";
}
?>