<?php
include('../connection.php');

session_start();

if (!isset($_SESSION['email'])) {
    header("Location: ../login-2.php");
    exit();
}

if (!isset($_GET['module_id'])) {
    echo "No module ID provided!";
    exit();
}

$module_id = $_GET['module_id'];
$user_email = $_SESSION['email'];

// Fetch user role
$sql_user = "SELECT role FROM user WHERE email = '$user_email'";
$result_user = mysqli_query($conn, $sql_user);

if ($result_user && mysqli_num_rows($result_user) > 0) {
    $user = mysqli_fetch_assoc($result_user);
    $user_role = $user['role'];
} else {
    echo "User not found.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $file = $_FILES['file']['name'];
    $target_dir = "../SamplePapers/";
    $target_file = $target_dir . basename($file);

    // Upload the file
    if (move_uploaded_file($_FILES['file']['tmp_name'], $target_file)) {
        // Insert document details into the database
        $sql = "INSERT INTO document (fichier, title, module_id) VALUES ('$file', '$title', '$module_id')";
        if (mysqli_query($conn, $sql)) {
            echo '<script>
            alert("Document uploaded successfully.");
            window.location.href = "addcours.php?module_id=' . $module_id . '";
            </script>';
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Add Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="png" href="images/icon/logo.PNG">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="files.css">
</head>

<body>
    <div class="container">
        <header>
            <div class="logo">
            <a href="../index.php"><img src="../images/icon/logo.png" alt="logo"></a>
            </div>
        </header>
        <center>
            <div class="quote">
                <div class="ccard">
                <?php if ($user_role === 'teacher'): ?>
                    <h1>Recent DOCUMENTS UPLOAD</h1>
                    <?php endif; ?>
                    <h1>DOCUMENTS</h1>
                    <div class="sample">
                        <ul>
                            <?php
                            // Fetch recent documents uploaded for the module
                            $sql_documents = "SELECT * FROM document WHERE module_id = '$module_id' ORDER BY id_doc DESC LIMIT 6";
                            $result_documents = mysqli_query($conn, $sql_documents);

                            if (mysqli_num_rows($result_documents) > 0) {
                                while ($document = mysqli_fetch_assoc($result_documents)) {
                            ?>
                                    <li>
                                        <strong><?php echo $document['title']; ?></strong>
                                        <p><a href="../SamplePapers/<?php echo $document['fichier']; ?>" target="_blank"><?php echo $document['fichier']; ?></a></p>
                                    </li>
                                <?php
                                }
                            } else {
                                ?>
                                <li>No documents uploaded yet.</li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </center>

        <?php if ($user_role === 'teacher'): ?>
        <center>
            <h1>UPLOAD NEW DOCUMENTS</h1>
            <form action="addcours.php?module_id=<?php echo $module_id; ?>" method="post" enctype="multipart/form-data">
                <label for="title">Document Title:</label><br>
                <input type="text" id="title" name="title" required><br>
                <label for="file">Select Document:</label><br>
                <input type="file" id="file" name="file" required><br><br>
                <input type="submit" value="Upload Document">
            </form>
        </center>
        <?php endif; ?>
    </div>

    <footer>
        <div class="footer-container">
            <div class="left-col">
                <img src="../images/icon/logo.PNG" style="width: 200px;">
                <div class="logo"></div>
                <div class="social-media">
                    <a href="https://www.facebook.com/iteam.university.tn"><img src="../images/icon/fb.png"></a>
                    <a href="https://www.instagram.com/iteamuniversity/?hl=fr"><img src="../images/icon/insta.png"></a>
                    <a href="#"><img src="../images/icon/tt.png"></a>
                    <a href="https://www.youtube.com/channel/UCQXhW-RMeABXLzuirSk7shw"><img src="../images/icon/ytube.png"></a>
                    <a href="https://www.linkedin.com/in/iteam-university-0916621a6/"><img src="../images/icon/linkedin.png"></a>
                </div><br><br>
                <p class="rights-text">Tous droits réservés © iTeam University 2023</p>
                <br>
                <p><img src="../images/icon/location.png"> iTeam University <br>85-87 Rue Palestine 1002 Tunis</p>
                <br>
                <p><img src="../images/icon/phone.png"> (216) 71 781 081<br><img src="../images/icon/mail.png">&nbsp;
                    info.iTeamE-Learning@iteam-univ.tn</p>
            </div>
            <div class="right-col">
                <h1 style="color: #fff">Our Newsletter</h1>
                <div class="border"></div><br>
                <p>Enter Your Email to get our News and updates.</p>
                <form class="newsletter-form">
                    <input class="txtb" type="email" placeholder="Enter Your Email">
                    <input class="btn" type="submit" value="Submit">
                </form>
            </div>
        </div>
    </footer>

</body>

</html>
