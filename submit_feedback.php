<?php
include "connection.php";

// Function to sanitize input data
function sanitize($data) {
    return htmlspecialchars(trim($data));
}

// Get form data
$userId = $_POST['userId'];
$firstName = sanitize($_POST['firstname']);
$email = sanitize($_POST['email']);
$message = sanitize($_POST['message']);

// Query to check if the user exists with the provided firstname and email
$checkUserQuery = "SELECT id FROM user WHERE nom = ? AND email = ?";
$stmt = $conn->prepare($checkUserQuery);
$stmt->bind_param("ss", $firstName, $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    // User not found, display an error message or redirect back to the form
    echo "<script>alert('User not found with the provided firstname and email. Please check your details.');</script>";
    // Redirect back to the homepage or the feedback form
    echo "<script>window.location.href = 'index.php';</script>";
} else {
    // User exists, proceed with inserting feedback
    $sql = "INSERT INTO feedback (idfeed, firstname, email, message) 
            VALUES (NULL, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $firstName, $email, $message);
    if ($stmt->execute()) {
        // Display success message
        echo "<script>alert('Feedback submitted successfully!');</script>";
        // Redirect back to the homepage or the feedback form
        echo "<script>window.location.href = 'index.php';</script>";
    } else {
        // Display error message
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
