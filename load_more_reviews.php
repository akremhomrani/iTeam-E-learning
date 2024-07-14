<?php
// Include database connection
include "connection.php";

// Query to fetch more reviews
$sql_more_reviews = "SELECT * FROM feedback ORDER BY idfeed DESC LIMIT 4, 100"; // Change the limit as needed
$result_more_reviews = mysqli_query($conn, $sql_more_reviews);

// Check if there are any more reviews
if (mysqli_num_rows($result_more_reviews) > 0) {
    // Loop through each additional review and display them
    while ($row = mysqli_fetch_assoc($result_more_reviews)) {
        $feedbackName = $row['firstname'];
        $feedbackContent = $row['message'];
        ?>
        <div class="rev-card">
            <div class="identity">
                <img src="images/creator/cherni.jpg">
                <div class="info">
                    <p><?php echo $feedbackName; ?></p>
                    <div class="rating">
                        <img src="images/icon/star.png"><img src="images/icon/star.png"><img src="images/icon/star.png"><img src="images/icon/star.png"><img src="images/icon/star.png">
                    </div>
                </div>
            </div>
            <div class="rev-cont">
                <p id="title">Review:</p>
                <p id="content"><?php echo $feedbackContent; ?></p>
            </div>
        </div>

        <?php
    }
} else {
    // Display a message if there are no more reviews
    echo "<p>No more reviews available.</p>";
}


?>

