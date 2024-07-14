<?php
session_start();
include('connection.php');

// Fetch users with the role of 'teacher'
$stmt = $conn->prepare("SELECT * FROM user WHERE role = 'teacher'");
if ($stmt === false) {
    die('Prepare failed: ' . htmlspecialchars($conn->error));
}

$stmt->execute();
if ($stmt->errno) {
    die('Execute failed: ' . htmlspecialchars($stmt->error));
}

$result = $stmt->get_result();
if ($result === false) {
    die('Get result failed: ' . htmlspecialchars($stmt->error));
}

$teachers = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" type="image/png" href="images/icon/logo.PNG">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teachers</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="teach.css">
</head>

<body>

    <div class="container">

        <header>
            <a href="index.php">
                <div class="logo">
                    <img src="images/icon/logo.png" alt="logo">
                </div>
            </a>
        </header>

        <h1 class="heading">Our Teachers</h1>

        <!-- Teacher section  -->
        <section class="teacher">
            <?php foreach ($teachers as $teacher): ?>
                <div class="box">
                    <img src="images/creator/<?php echo htmlspecialchars($teacher['image']); ?>" alt="">
                    <h3><?php echo htmlspecialchars($teacher['nom'] . ' ' . htmlspecialchars($teacher['prenom'])); ?></h3>
                    <span><?php echo htmlspecialchars($teacher['role']); ?></span>
                    <div class="share">
                        <a href="mailto:<?php echo htmlspecialchars($teacher['email']); ?>" target="_blank" rel="noopener noreferrer">
                            <i class="fas fa-envelope"></i>
                        </a>
                        <a href="profile/profile.php?id=<?php echo htmlspecialchars($teacher['id']); ?>" rel="noopener noreferrer">
                            <i class="fas fa-user"></i>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>

    <footer>
        <div class="footer-container">
            <div class="left-col">
                <img src="images/icon/logo.PNG" style="width: 200px;">
                <div class="logo"></div>
                <div class="social-media">
                    <a href="https://www.facebook.com/iteam.university.tn"><img src="images/icon/fb.png"></a>
                    <a href="https://www.instagram.com/iteamuniversity/?hl=fr"><img src="images/icon/insta.png"></a>
                    <a href="#"><img src="images/icon/tt.png"></a>
                    <a href="https://www.youtube.com/channel/UCQXhW-RMeABXLzuirSk7shw"><img src="images/icon/ytube.png"></a>
                    <a href="https://www.linkedin.com/in/iteam-university-0916621a6/"><img src="images/icon/linkedin.png"></a>
                </div><br><br>
                <p class="rights-text">Tous droits réservés © iTeam University 2023</p><br>
                <p><img src="images/icon/location.png"> iTeam University <br>85-87 Rue Palestine 1002 Tunis</p><br>
                <p><img src="images/icon/phone.png"> (216) 71 781 081<br><img src="images/icon/mail.png">&nbsp; info.iTeamE-Learning@iteam-univ.tn</p>
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
