<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Services.css">
    <title>Our Services</title>
</head>
<body>

<div class="header">
    <h1>Our Services</h1>
</div>

<div class="container">
    <?php
    // Define services array
    $services = [
        ["name" => "Web Development", "description" => "We offer full-stack web development services, creating responsive and modern websites."],
        ["name" => "Mobile App Development", "description" => "We build mobile apps for both Android and iOS platforms."],
        ["name" => "SEO Optimization", "description" => "Our SEO experts help you rank higher in search engines and drive more traffic to your website."],
        ["name" => "Graphic Design", "description" => "Our creative designers deliver logos, brochures, and other digital artwork to meet your branding needs."],
        ["name" => "Cloud Services", "description" => "We provide cloud infrastructure setup and management, ensuring your data is always available and secure."],
    ];

    // Loop through services and display only names as clickable links
    foreach ($services as $key => $service) {
        echo "<div class='service'>";
        echo "<h2><a href='#' class='service-link' data-service-id='" . $key . "'>" . $service['name'] . "</a></h2>";
        echo "<p class='description' id='description-" . $key . "' style='display:none;'></p>"; 
        echo "</div>";
    }
    ?>
</div>

<!-- Feedback Form -->
<div class="feedback">
    <h2>Feedback / Inquiries</h2>
    <form id="feedbackForm">
        <input type="text" name="name" placeholder="Your Name" required>
        <input type="email" name="email" placeholder="Your Email" required>
        <textarea name="message" placeholder="Your Message" required></textarea>
        <button type="submit">Submit Feedback</button>
    </form>
    <div id="feedbackResponse" style="display:none;"></div> <!-- Response message -->
    <div id="userFeedback" style="display:none;">Thank you for your feedback!</div> <!-- User feedback -->
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Attach click event listeners to all service links
    document.querySelectorAll('.service-link').forEach(function(link) {
        link.addEventListener('click', function(event) {
            event.preventDefault();  // Prevent default anchor click behavior
            
            const serviceId = this.getAttribute('data-service-id'); // Get service ID
            
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'services_details.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Display the response (description) in the appropriate paragraph
                    document.getElementById('description-' + serviceId).innerHTML = xhr.responseText;
                    document.getElementById('description-' + serviceId).style.display = 'block'; // Show the description
                }
            };
            
            // Send the request with the service ID
            xhr.send('service_id=' + serviceId);
        });
    });

    // Handle feedback form submission
    document.getElementById('feedbackForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        const formData = new FormData(this); // Create FormData object

        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'submit_feedback.php', true); // Point to the PHP script that handles feedback
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                document.getElementById('feedbackResponse').innerHTML = xhr.responseText; // Display response message
                document.getElementById('feedbackResponse').style.display = 'block'; // Show response
                document.getElementById('userFeedback').style.display = 'block'; // Show user feedback message
                document.getElementById('feedbackForm').reset(); // Reset the form
            }
        };

        xhr.send(formData); // Send the form data
    });
});
</script>

</body>
</html>