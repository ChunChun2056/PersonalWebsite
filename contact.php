<?php
// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {
    // Define recipient's email address
    $to = "sanacharya000@gmail.com";
    
    // Sanitize sender's email and name
    $from = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $full_name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    
    // Sanitize sender's phone number and message
    $number = filter_input(INPUT_POST, 'number', FILTER_SANITIZE_NUMBER_INT);
    $messageBody = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
    
    // Determine the sender's IP address more reliably
    $ip_address = $_SERVER['HTTP_CLIENT_IP'] ?? $_SERVER['HTTP_X_FORWARDED_FOR'] ?? $_SERVER['REMOTE_ADDR'];
    
    // Compile the email subject and message
    $subject = "Contact message from " . $full_name;
    $message = "Full Name: " . $full_name . "\n" .
               "IP Address: " . $ip_address . "\n" . 
               "Phone Number: " . $number . "\n\n" . 
               " wrote the following:" . "\n\n" . 
               $messageBody;
               
    // Define email headers
    $headers = [
        'From' => $from,
        // Add more headers as needed
    ];
    
    // Convert the headers array into a string
    $headersString = "";
    foreach ($headers as $key => $value) {
        $headersString .= "$key: $value\r\n";
    }
    
    // Check for a honeypot field to prevent simple bots (assume 'lastname' is the honeypot field)
    if (empty($_POST["lastname"])) {
        // Send the email
        mail($to, $subject, $message, $headersString);
    }
    
    // Redirect with a success indicator
    header("Location: /?success=1");
    exit; // Ensure no further execution happens after redirect
}
?>
