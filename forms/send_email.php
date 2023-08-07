<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Email recipient (your email address)
    $to = "ppl_peter@live.dk";

    // Subject of the email
    $subject = "Website contact";

    // Email content
    $email_content = "Name: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Message:\n$message\n";

    // Headers
    $headers = "From: $email\n";
    $headers .= "Reply-To: $email\n";

    // Send the email
    if (mail($to, $subject, $email_content, $headers)) {
        // If the email is sent successfully, redirect to a thank-you page
        header("Location: thank_you.html");
        exit;
    } else {
        // If there's an error sending the email, display an error message
        echo "Oops! Something went wrong. Please try again later.";
    }
}
?>