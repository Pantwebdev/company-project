<?php
header('Content-Type: application/json');

// Enable error reporting for debugging (remove in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

$errors = [];
$input = [];

// Sanitize all inputs
foreach ($_POST as $key => $value) {
    $input[$key] = htmlspecialchars(trim($value));
}

// Validation rules
if (empty($input['name'])) {
    $errors['name'] = "Name is required";
} elseif (strlen($input['name']) < 2) {
    $errors['name'] = "Name must be at least 2 characters";
}

if (empty($input['email'])) {
    $errors['email'] = "Email is required";
} elseif (!filter_var($input['email'], FILTER_VALIDATE_EMAIL)) {
    $errors['email'] = "Please enter a valid email address";
}

// Mobile validation - exactly 10 digits
if (empty($input['mobile'])) {
    $errors['mobile'] = "Mobile number is required";
} elseif (!preg_match('/^[0-9]{10}$/', $input['mobile'])) {
    $errors['mobile'] = "Please enter a valid 10-digit mobile number";
}

// if (empty($input['message'])) {
//     $errors['message'] = "Message is required";
// } elseif (strlen($input['message']) < 10) {
//     $errors['message'] = "Message must be at least 10 characters";
// }

// Service field is only required for index page form
if (isset($input['service']) && empty($input['service'])) {
    $errors['service'] = "Please select a service";
}

// If there are errors, return them
if (!empty($errors)) {
    echo json_encode([
        "status" => "error", 
        "errors" => $errors,
        "message" => "Please fix the errors below"
    ]);
    exit;
}

// Email configuration
$to = "prezence.in@gmail.com";
$source = isset($input['source']) ? $input['source'] : "Website Contact Form";

$subject = "New Inquiry from $source - " . date('Y-m-d H:i:s');

// Build email body
$body = "
NEW CONTACT FORM SUBMISSION
============================

Source: $source
Submission Time: " . date('Y-m-d H:i:s') . "

Contact Details:
----------------
Name: {$input['name']}
Email: {$input['email']}
Mobile: {$input['mobile']}
" . (isset($input['service']) ? "Service: {$input['service']}\n" : "") . "

Message:
--------
{$input['message']}

------------------------------
This email was sent from your website contact form.
";

// Email headers
// $headers = "From: Website Contact <noreply@prezence.in>\r\n";
// $headers .= "Reply-To: {$input['email']}\r\n";
// $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
// $headers .= "X-Mailer: PHP/" . phpversion();

$headers = "From: prezence.in@gmail.com\r\n";
$headers .= "Reply-To: {$input['email']}\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
$headers .= "X-Mailer: PHP/" . phpversion();


// Send email
$mailSent = mail($to, $subject, $body, $headers);

if ($mailSent) {
    // Log the submission (optional)
    $logEntry = [
        'timestamp' => date('Y-m-d H:i:s'),
        'source' => $source,
        'name' => $input['name'],
        'email' => $input['email'],
        'mobile' => $input['mobile'],
        'status' => 'success'
    ];
    
    // You can save this to a file or database
    // file_put_contents('contact_log.txt', json_encode($logEntry) . PHP_EOL, FILE_APPEND);
    
    echo json_encode([
        "status" => "success",
        "message" => "Thank you! Your message has been sent successfully. We'll get back to you within 24 hours."
    ]);
} else {
    echo json_encode([
        "status" => "error",
        "message" => "Sorry, there was a problem sending your message. Please try again or contact us directly at prezence.in@gmail.com"
    ]);
}

exit;
?>