<?php
session_start(); 

include('connection.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php'); // Redirect to another page, like index.php
    exit();
}

$emailValue = '';
if (isset($_POST['submit'])) {
    $emailValue = $_POST['email']; 
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE email = '$emailValue'";
    $result_log = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result_log, MYSQLI_ASSOC);
    $count = mysqli_num_rows($result_log);

    if ($count == 1 && password_verify($password, $row["password"])) {
        if ($row['status'] == 'Not active') {
            $_SESSION['login_error'] = "Login failed. Your account is pending approval.";
        } else {
            $_SESSION['email'] = $row['email'];
            $_SESSION['loggedin'] = true;
            $_SESSION['role'] = $row['role']; 
            $_SESSION['id '] = $row['id']; 
    
            header('location: index.php'); 
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Login failed. Invalid email or password!";
    }
    
}
?>
<!DOCTYPE html>
<html lang="zxx">

<head>

    <title>iTeamElearning - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="images/icon/logo.png" type="image/x-icon">

    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">

</head>

<body id="top">
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <div class="page_loader"></div>

    <!-- Login 2 start -->
    <div class="login-2">
        <div class="container">
            <div class="row login-box">
                <div class="col-lg-6 col-md-12 bg-img">
                    <div class="info">
                        <div class="info-text">
                            <div class="waviy">
                                <span style="--i:1">w</span>
                                <span style="--i:2">e</span>
                                <span style="--i:3">l</span>
                                <span style="--i:4">c</span>
                                <span style="--i:5">o</span>
                                <span style="--i:6">m</span>
                                <span style="--i:7">e</span>
                                <span class="color-yellow" style="--i:8">t</span>
                                <span class="color-yellow" style="--i:9">o</span>
                                <span style="--i:10">I</span>
                                <span style="--i:11">T</span>
                                <span style="--i:12">E</span>
                                <span style="--i:13">A</span>
                                <span style="--i:14">M</span>
                            </div>
                        <p>elcome to the login page! Here, you can securely access your account and stay connected with all the features and services we offer. Logging in is simple and ensures that you have personalized access to your profile and settings. Enter your username and password in the fields below and click the "Login" button to proceed. We prioritize your privacy and security, so rest assured that your information is kept confidential and protected. If you encounter any issues or have forgotten your password, use the links provided to get assistance. Thank you for logging in and staying connected with us.</p>
                            <div class="social-buttons">
                                <a href="#" class="social-button social-button-facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a href="#" class="social-button social-button-twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                                <a href="#" class="social-button social-button-google">
                                    <i class="fa fa-google"></i>
                                </a>
                                <a href="#" class="social-button social-button-linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 form-info">
                    <div class="form-section">
                        <div class="logo clearfix">
                            <a href="index.php">
                                <img src="images/icon/logo.png" alt="logo">
                            </a>
                        </div>
                        <h3>Sign Into Your Account</h3>
                        <div class="login-inner-form">
                            <form  method="POST" id="loginForm">
                            <div id="error-container" style="color: #dc3545;">
</div>

<div class="form-group form-box">
    <input type="email" name="email" class="form-control" placeholder="Email Address"
        aria-label="Email Address" value="<?php echo htmlspecialchars($emailValue); ?>">
    <i class="flaticon-mail-2"></i>
</div>
<div class="form-group form-box">
    <input type="password" name="password" class="form-control" autocomplete="off"
        placeholder="Password" aria-label="Password">
    <i class="flaticon-password"></i>
</div>
                                <div class="form-group mb-0">
                                    <button type="submit" name="submit" class="btn-md btn-theme"
                                        id="loginbtn">Login</button>
                                </div>
                                <?php
    if (isset($_SESSION['login_error'])) {
        echo '<div id="error-container" style="color: #dc3545;">' . $_SESSION['login_error'] . '</div>';
        unset($_SESSION['login_error']); // Clear the session variable after displaying
    }
    ?>

                                <p class="text">Don't have an account?<a href="register-2.php"> Register here</a></p>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="signin.js"></script> <!-- Add your custom JavaScript file -->
    <script src="login.js"></script>
</body>

</html>