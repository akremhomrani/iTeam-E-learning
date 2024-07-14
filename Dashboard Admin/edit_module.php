<?php
session_start();

include('../connection.php');

// Check if module ID is provided in the query parameters
if(isset($_GET['edit_module'])) {
    $editModuleId = $_GET['edit_module'];
    
    // Query to retrieve module details by ID
    $sql = "SELECT * FROM module WHERE idmod = $editModuleId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Fetch module details
        $moduleDetails = $result->fetch_assoc();
        // Output module details as JSON
        echo json_encode($moduleDetails);
    } else {
        // Module not found
        echo json_encode(null);
    }
} else {
    // Module ID not provided
    echo json_encode(null);
}
?>
