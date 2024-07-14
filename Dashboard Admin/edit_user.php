<?php
session_start();
include('../connection.php'); 

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/src/Exception.php';
require 'mailer/src/PHPMailer.php';
require 'mailer/src/SMTP.php';

if (isset($_POST['submit'])) {
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'homraniakremphoto@gmail.com'; // Your gmail
        $mail->Password = 'xhov erqj jqjx qiyj'; // Your gmail app password
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('homraniakremphoto@gmail.com', 'iTeam E-Learning - Update'); // Your gmail and name
        $mail->addAddress($_POST['email']); 

        $mail->isHTML(true);
        $mail->Subject = 'User Status Update';

        $status = htmlspecialchars($_POST['status']);
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        
        if ($nom !== $current_nom || $prenom !== $prenom || $email !== $current_email || $phone !== $current_phone) {
            $userUpdateMessage = "<p>User details have been updated:</p>";
        } else {
            $userUpdateMessage = ""; 
        }
        
        $mailContent = "<h1>Your details updated</h1>
                        <p>FirstName: {$nom}</p>
                        <p>LastName: {$prenom}</p>
                        <p>Email: {$email}</p>
                        <p>Phone: {$phone}</p>
                        {$userUpdateMessage}";
        
        if ($status === 'active') {
            $mailContent .= "<p>Your status has been updated to: <strong>{$status}</strong></p>
                            <p>Your account is now activated. You are ready to access it.</p>";
        } else {
            $mailContent .= "<p>Your status remains unchanged: <strong>{$status}</strong></p>
                            <p>Please check your account for more details.</p>";
        }
        
        $mail->Body = $mailContent;

        $mail->send();
        echo "<script>
                alert('Sent Successfully');
                document.location.href = 'users.php';
              </script>";
    } catch (Exception $e) {
        echo "<script>
                alert('Message could not be sent. Mailer Error: {$mail->ErrorInfo}');
                document.location.href = 'users.php';
              </script>";
    }
}


$id = '';
$nom = '';
$prenom = '';
$email = '';
$password = '';
$role = '';
$status = '';     
$phone = '';
$datenaiss = '';

if (isset($_GET['user_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['user_id']);

    $sql = "SELECT * FROM `user` WHERE `id`='$id'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nom = $row['nom'];
        $prenom = $row['prenom'];
        $email = $row['email'];
        $phone = $row['phone'];
        $role = $row['role'];
        $status = $row['status'];        
        $datenaiss = $row['datenaiss'];
    } else {
        header("Location: users.php");
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = mysqli_real_escape_string($conn, $_POST['user_id']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $datenaiss = mysqli_real_escape_string($conn, $_POST['datenaiss']);

    error_log("Date of Birth: " . $datenaiss);

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE `user` SET 
        `nom`='$nom',
        `prenom`='$prenom',
        `email`='$email',
        `password`='$hash',
        `role`='$role',
        `status`='$status',
        `phone`='$phone',
        `datenaiss`='$datenaiss'
        WHERE `id`='$id'";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "User updated successfully.";
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }

    header("Location: ../Dashboard Admin/users.php");
    exit();
}
?>
