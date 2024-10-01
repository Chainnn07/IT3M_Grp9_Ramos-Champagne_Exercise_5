<?php
// view_feedback.php

// Set the file path for reading feedback
$file_path = 'feedback.txt';

// Check if the feedback file exists and is readable
if (file_exists($file_path) && is_readable($file_path)) {
    // Read the content of the feedback file
    $feedback_content = file_get_contents($file_path);
    
    // Display the feedback
    echo "<h2>Feedback Entries</h2>";
    echo "<pre>" . htmlspecialchars($feedback_content) . "</pre>";
} else {
    echo "No feedback available or file is not accessible.";
}
?>