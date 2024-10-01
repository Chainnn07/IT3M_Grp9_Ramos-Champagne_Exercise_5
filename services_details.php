<?php

// Array of services
$services = [
    ["name" => "Web Development", "description" => "We offer full-stack web development services, creating responsive and modern websites."],
    ["name" => "Mobile App Development", "description" => "We build mobile apps for both Android and iOS platforms."],
    ["name" => "SEO Optimization", "description" => "Our SEO experts help you rank higher in search engines and drive more traffic to your website."],
    ["name" => "Graphic Design", "description" => "Our creative designers deliver logos, brochures, and other digital artwork to meet your branding needs."],
    ["name" => "Cloud Services", "description" => "We provide cloud infrastructure setup and management, ensuring your data is always available and secure."],
];

// Get the service ID from the AJAX request
if (isset($_POST['service_id'])) {
    $serviceId = intval($_POST['service_id']);
    
    // Output the corresponding description
    if (isset($services[$serviceId])) {
        echo $services[$serviceId]['description'];
    } else {
        echo "Service not found.";
    }
}


?>