<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'dashboard Admin/mailer/src/Exception.php';
require 'dashboard Admin/mailer/src/PHPMailer.php';
require 'dashboard Admin/mailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'homraniakremphoto@gmail.com'; // Your gmail
    $mail->Password = 'xhov erqj jqjx qiyj'; // Your gmail app password
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port = 587; // TCP port to connect to

    //Recipients
    $mail->setFrom('homraniakremphoto@gmail.com', 'iTeam E-Learning Contact Us');
    $mail->addAddress('akr3m.homrani@gmail.com'); // Add a recipient

    //Content
    $mail->isHTML(true);
    $subject = 'Contact Form Submission from ' . $_POST['fname'] . ' ' . $_POST['lname'];
    $body = 'First Name: ' . $_POST['fname'] . '<br>' .
            'Last Name: ' . $_POST['lname'] . '<br>' .
            'Email: ' . $_POST['email'] . '<br>' .
            'Message: ' . $_POST['message'] . '<br>' .
            'Additional Details: ' . $_POST['additional'];

    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->send();
    echo "<script>
    alert('Sent Successfully');
    document.location.href = 'index.php';
  </script>";
} catch (Exception $e) {
echo "<script>
    alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
    document.location.href = 'index.php';
  </script>";
}

?>
