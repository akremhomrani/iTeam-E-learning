<?php
session_start();
include('../connection.php');

header('Content-Type: application/json'); // Set content type to JSON

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Gather form data
    $nom = $_POST['first_name'];
    $prenom = $_POST['last_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $status = $_POST['status'];
    $datenaiss = $_POST['datenaiss'];
    $role = $_POST['role'];
    $group_id = $_POST['group'];

    // Handle image upload
    $image = "";
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = basename($_FILES["image"]["name"]);
        $target_dir = "../images/creator";
        $target_file = $target_dir . $image;
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    }

    // Insert user into the database
    $sql = "INSERT INTO `user` (nom, prenom, email, phone, password, status, image, role, datenaiss) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nom, $prenom, $email, $phone, $password, $status, $image, $role, $datenaiss);

    if ($stmt->execute()) {
        // Get the last inserted user's ID
        $user_id = $stmt->insert_id;

        // Assign the user to a group
        $sql_group = "INSERT INTO `user_group` (user_id, group_id) VALUES (?, ?)";
        $stmt_group = $conn->prepare($sql_group);
        $stmt_group->bind_param("ii", $user_id, $group_id);

        if ($stmt_group->execute()) {
            echo json_encode(["status" => "success", "message" => "New user created and assigned to the group successfully."]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error assigning user to group: " . $conn->error]);
        }

        $stmt_group->close();
    } else {
        echo json_encode(["status" => "error", "message" => "Error creating user: " . $conn->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method."]);
}
?>
