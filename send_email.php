<?php
header('Content-Type: application/json');

// Only accept POST requests
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    http_response_code(405);
    echo json_encode(['error' => 'Invalid request method.']);
    exit;
}

// Sanitize inputs
$name        = isset($_POST['name'])        ? htmlspecialchars(trim($_POST['name']))        : '';
$mobile      = isset($_POST['mobile'])      ? htmlspecialchars(trim($_POST['mobile']))      : '';
$email       = isset($_POST['email'])       ? htmlspecialchars(trim($_POST['email']))       : '';
$form_name   = isset($_POST['form_name'])   ? htmlspecialchars(trim($_POST['form_name']))   : '';
$website_url = isset($_POST['website_url']) ? htmlspecialchars(trim($_POST['website_url'])) : '';
$price       = isset($_POST['price'])       ? htmlspecialchars(trim($_POST['price']))       : '';
$currentUrl  = isset($_POST['currentUrl'])  ? htmlspecialchars(trim($_POST['currentUrl']))  : '';

// Validate required fields
if (!$name || !$email || !$form_name) {
    http_response_code(400);
    echo json_encode(['error' => 'Missing required fields: name, email, or form_name.']);
    exit;
}

// Validate email format
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid email address.']);
    exit;
}

// Prepare mail
$to = "bitkittu@gmail.com";
$subject = "New Form Submission from $form_name";
$message = "Name: $name\n";
$message .= "Mobile: $mobile\n";
$message .= "Email: $email\n";
$message .= "Form Name: $form_name\n";
$message .= "Website URL: $website_url\n";
$message .= "Price: $price\n";
$message .= "Current URL: $currentUrl\n";
$headers = "From: noreply@" . $_SERVER['SERVER_NAME'] . "\r\n";
$headers .= "Reply-To: $email\r\n";

// Attempt to send mail
if (mail($to, $subject, $message, $headers)) {
    echo json_encode(['success' => true, 'message' => 'Email sent successfully!']);
} else {
    http_response_code(500);
    echo json_encode(['error' => 'Failed to send email.']);
}
?>