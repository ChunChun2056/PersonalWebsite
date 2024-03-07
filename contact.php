<?php
if (isset($_POST['submit'])) {
    $to = "sanacharya000@gmail.com"; // Recipient's Email address
    $from = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL); // Sender's Email address, sanitized
    // Custom sanitization for strings using htmlspecialchars to prevent XSS
    $full_name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'); // Sender's name, sanitized
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT); // Sender's phone number, sanitized
    $messageBody = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8'); // Message body, sanitized

    // Determine the sender's IP address
    $ip_address = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];

    $subject = "Contact message from " . $full_name;
    $message = "Full Name: " . $full_name . "\n\n" . 
               "IP Address: " . $ip_address . "\n" . 
               "Phone Number: " . $number . "\n\n" . 
               " wrote the following:" . "\n\n" . 
               $messageBody;
    $headers = "From: " . $from;

    mail($to, $subject, $message, $headers);
    header("Location: /?success=1");
}
?>
