<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name    = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $mobile  = isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile']) : '';
    $email   = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $form_name = isset($_POST['form_name']) ? htmlspecialchars($_POST['form_name']) : '';
    $website_url = isset($_POST['website_url']) ? htmlspecialchars($_POST['website_url']) : '';
    $price   = isset($_POST['price']) ? htmlspecialchars($_POST['price']) : '';
    $currentUrl = isset($_POST['currentUrl']) ? htmlspecialchars($_POST['currentUrl']) : '';

    $to = "okchanakya@gmail.com";
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

    if (mail($to, $subject, $message, $headers)) {
        echo "success";
    } else {
        http_response_code(500);
        echo "error";
    }
} else {
    http_response_code(403);
    echo "Forbidden";
}
?>