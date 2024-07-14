<?php
include ('../connection.php');
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['email'])) {
    die("You must be logged in to view this page.");
}

// Fetch user email from session
$user_email = $_SESSION['email'];

// Get user group based on email
$sql_user_group = "
    SELECT `group`.formation, `group`.year 
    FROM `user`
    INNER JOIN `user_group` ON `user`.id = `user_group`.user_id
    INNER JOIN `group` ON `group`.id_g = `user_group`.group_id
    WHERE `user`.email = '$user_email'";

$result_user_group = mysqli_query($conn, $sql_user_group);

if (!$result_user_group || mysqli_num_rows($result_user_group) == 0) {
    die("Could not fetch user group information: " . mysqli_error($conn));
}

$user_group_info = mysqli_fetch_assoc($result_user_group);
$group_name = $user_group_info['formation'];
$year = $user_group_info['year'];

// Check if the user's group is "Masters" and year is 2
if ($group_name == 'Masters' && $year == 2) {
    // Fetch modules for the group "Masters" and year 2
    $sql_modules = "SELECT * FROM module 
                    INNER JOIN group_module ON module.idmod = group_module.module_id
                    INNER JOIN `group` ON `group`.id_g = group_module.group_id
                    WHERE `group`.formation = 'Masters' AND `group`.year = '2'";

    $result_modules = mysqli_query($conn, $sql_modules);

    if (!$result_modules) {
        die("Query Failed: " . mysqli_error($conn));
    }

    $has_modules = mysqli_num_rows($result_modules) > 0;
    ?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="png" href="../../images/icon/logo.PNG">
    <title>Masters</title>
    <link rel="stylesheet" type="text/css" href="../subjects.css">
    <script type="text/javascript" src="../../script.js"></script>
</head>
<body>

<!-- NAVIGATION -->
<header>
    <div class="nav" id="nav">
        <div id="learned-logo">
            <a href="../index.php"><img src="../../images/icon/logo.png" style="width: 120px;"></a>
        </div>
        <div class="switch-tab" id="switch-tab" onclick="switchTAB()"><img src="../../images/icon/menu.png"></div>
        <ul id="list-switch">
            <li><a href="computer_courses.php"><img src="../../images/courses/d1.png" class="icon">Courses</a></li>
        </ul>
        <div class="search" id="search-switch">
            <input type="text" id="search-input" placeholder="Search" class="srch">
        </div>
    </div>
</header>
<!-- Courses Available -->
<div class="inbt">
    Courses Masters 2nd
</div>

<div class="ccard">
    <center>
        <div class="ccaardbox" id="module-list">
            <?php if ($has_modules): ?>
                <?php while ($module = mysqli_fetch_assoc($result_modules)): ?>
                    <div class="dcard">
                        <div class="fpart"></div>
                        <a href="#<?php echo $module['title']; ?>">
                            <div class="spart"><?php echo $module['title']; ?><img src="../../images/icon/dropdown.png"></div>
                        </a>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <!-- Display nothing if no modules found -->
            <?php endif; ?>
        </div>
    </center>
</div>
<footer>
    <div class="footer-container">
        <div class="left-col">
            <img src="../../images/icon/logo.PNG" style="width: 200px;">
            <div class="logo"></div>
            <div class="social-media">
                <a href="#"><img src="../../images/icon\fb.png"></a>
                <a href="#"><img src="../../images/icon\insta.png"></a>
                <a href="#"><img src="../../images/icon\tt.png"></a>
                <a href="#"><img src="../../images/icon\ytube.png"></a>
                <a href="#"><img src="../../images/icon\linkedin.png"></a>
            </div><br><br>
            <p class="rights-text">Tous droits réservés © iTeam University 2023</p>
            <br>
            <p><img src="../../images/icon/location.png"> iTeam University <br>85-87 Rue Palestine 1002 Tunis</p>
            <br>
            <p><img src="../../images/icon/phone.png"> (216) 71 781 081<br><img src="../../images/icon/mail.png">&nbsp; info.iTeamE-Learning@iteam-univ.tn</p>
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

<?php
} else {
?>
<!DOCTYPE html>
<html>
<head>
<link rel="shortcut icon" type="png" href="../../images/icon/logo.PNG">
    <title>Masters</title>
    <link rel="stylesheet" type="text/css" href="../subjects.css">
    <script type="text/javascript" src="../../script.js"></script>
</head>
<style>
    .centered-message {
    color: white;
    text-align: center;
    font-size: 18px; 
    padding: 20px;
}

</style>
<body>

<!-- NAVIGATION -->
<header>
    <div class="nav" id="nav">
        <div id="learned-logo">
            <a href="../index.php"><img src="../../images/icon/logo.png" style="width: 120px;"></a>
        </div>
        <div class="switch-tab" id="switch-tab" onclick="switchTAB()"><img src="../../images/icon/menu.png"></div>
        <ul id="list-switch">
            <li><a href="computer_courses.php"><img src="../../images/courses/d1.png" class="icon">Courses</a></li>
        </ul>
        <div class="search" id="search-switch">
            <input type="text" id="search-input" placeholder="Search" class="srch">
        </div>
    </div>
</header>
<!-- Courses Available -->
<div class="inbt">
    Courses Masters 2nd
</div>

    <div class="ccard">
        <center>
            <div class="ccardbox">
                <div class="dcard">
                <p class="centered-message">You are not authorized to view this page.</p>
                </div>
            </div>
        </center>
    </div>
    <footer>
    <div class="footer-container">
        <div class="left-col">
            <img src="../../images/icon/logo.PNG" style="width: 200px;">
            <div class="logo"></div>
            <div class="social-media">
                <a href="#"><img src="../../images/icon\fb.png"></a>
                <a href="#"><img src="../../images/icon\insta.png"></a>
                <a href="#"><img src="../../images/icon\tt.png"></a>
                <a href="#"><img src="../../images/icon\ytube.png"></a>
                <a href="#"><img src="../../images/icon\linkedin.png"></a>
            </div><br><br>
            <p class="rights-text">Tous droits réservés © iTeam University 2023</p>
            <br>
            <p><img src="../../images/icon/location.png"> iTeam University <br>85-87 Rue Palestine 1002 Tunis</p>
            <br>
            <p><img src="../../images/icon/phone.png"> (216) 71 781 081<br><img src="../../images/icon/mail.png">&nbsp; info.iTeamE-Learning@iteam-univ.tn</p>
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

<?php
}
?>
<!-- FOOTER -->

<script>

    document.getElementById('search-input').addEventListener('input', function() {
        const searchQuery = this.value.toLowerCase(); 
        const moduleList = document.getElementById('module-list').getElementsByClassName('dcard');
        Array.from(moduleList).forEach(function(module) {
            const moduleName = module.querySelector('.spart').innerText.toLowerCase();
            if (moduleName.includes(searchQuery)) {
                module.style.display = 'block'; 
            } else {
                module.style.display = 'none'; 
            }
        });
    });
</script>

</body>
</html>

