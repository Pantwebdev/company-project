<?php
header('Content-Type: application/json');

$errors = [];
$input = [];

// Sanitize email
$email = htmlspecialchars(trim($_POST['email']));

// Validation
if (empty($email)) {
    $errors['email'] = "Email is required";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address";
}

if (!empty($errors)) {
    echo json_encode(["status" => "error", "errors" => $errors]);
    exit;
}

// Email configuration
$to = "prezence.in@gmail.com";
$subject = "New Newsletter Subscription";
$body = "New newsletter subscription:\n\nEmail: $email\n\n---\nThis email was sent from your website newsletter form.";
$headers = "From: prezence.in@gmail.com\r\n";

$headers .= "Reply-To: $email\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

if (mail($to, $subject, $body, $headers)) {
    echo json_encode(["status" => "success", "message" => "Thank you for subscribing!"]);
} else {
    echo json_encode(["status" => "error", "message" => "Sorry, there was a problem. Please try again."]);
}
?>