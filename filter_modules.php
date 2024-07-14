<?php
// Include database connection file
include('connection.php');

if(isset($_GET['formation']) && $_GET['formation'] != '') {
    $formation = $_GET['formation'];

    // Fetch modules based on the selected formation
    $sql = "SELECT * FROM `module` WHERE formation = '$formation'";
    $result = mysqli_query($conn, $sql);

    // Display filtered modules
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Contenu:</strong> " . $row['contenu'] . "</p>";
        echo "<p><strong>Date Added:</strong> " . $row['dateadd'] . "</p>";
        echo "<p><strong>Formation:</strong> " . $row['formation'] . "</p>";
        echo "</div>";
    }
} else {
    // If no formation is selected, display all modules
    $sql = "SELECT * FROM `module`";
    $result = mysqli_query($conn, $sql);

    // Display all modules
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
        echo "<p><strong>Contenu:</strong> " . $row['contenu'] . "</p>";
        echo "<p><strong>Date Added:</strong> " . $row['dateadd'] . "</p>";
        echo "<p><strong>Formation:</strong> " . $row['formation'] . "</p>";
        echo "</div>";
    }
}
?>
