<?php
include('connection.php');
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php'); 
    exit();
}
if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pass'], $_POST['datenaiss'], $_POST['phone'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $datenaiss = mysqli_real_escape_string($conn, $_POST['datenaiss']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $sql = "SELECT * FROM user WHERE email='$email'";
    $result_email = mysqli_query($conn, $sql);
    $count_email = mysqli_num_rows($result_email);
    if ($count_email == 0) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $status = 'Not active';
        $role = 'user'; 

        $sql = "INSERT INTO user (nom, prenom, email, password, status, role, datenaiss, phone) VALUES ('$nom', '$prenom', '$email', '$hash', '$status', '$role', '$datenaiss', '$phone')";
        $result_insert = mysqli_query($conn, $sql);

        if ($result_insert) {
            echo '<script>
                    alert("Your registration is pending approval. Please wait for admin confirmation.");
                    window.location.href = "login-2.php";
                </script>';
        } else {
            echo '<script>
                    alert("Error occurred while registering user");
                    window.location.href = "login-2.php";
                </script>';
        }
    } else {
        echo '<script>
                alert("Email already exists");
                window.location.href = "login-2.php";
            </script>';
    }
} elseif (!empty($_POST)) {
    header("Location: registre-2.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>iTeamElearning - Register</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    <link type="text/css" rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="assets/fonts/flaticon/font/flaticon.css">

    <!-- Favicon icon -->
    <link rel="shortcut icon" href="images/icon/logo.png" type="image/x-icon" >
    <!-- Google fonts -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800%7CPoppins:400,500,700,800,900%7CRoboto:100,300,400,400i,500,700">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Custom Stylesheet -->
    <link type="text/css" rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" type="text/css" id="style_sheet" href="assets/css/skins/default.css">

</head>
<body id="top">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-TAGCODE"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>

<div class="page_loader"></div>


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
                        <p>
                        Welcome to the sign-up page! Here, you can create a new account and join our community. Signing up is quick and easy, allowing you to access all the features and benefits we offer. Simply fill in the fields below with your information and click the "Sign Up" button to get started. We value your privacy and security, so rest assured that your information is kept confidential and protected. By creating an account, you gain personalized access to our services and can manage your profile and settings with ease. Thank you for joining us and becoming part of our community!</p>                        <div class="social-buttons">
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
                        <img src="images/icon/logo.png" alt="logo" >

                        </a>
                    </div>
                    
                    <h3 >Create An Account</h3>
                    <div class="login-inner-form">
                    <form id="register"  method="POST">
                        <div id="error-container" style="color: #dc3545;"></div>


                        <div class="input-container">

                            <div class="form-group form-box">
                                <input type="text" name="nom" class="form-control" placeholder="First Name" aria-label="First Name">
                                <i class="flaticon-user"></i>
                            </div>
                            <div class="form-group form-box">
                                <input type="text" name="prenom" class="form-control" placeholder="Last Name" aria-label="Last Name">
                                <i class="flaticon-user"></i>
                            </div>

                            </div>
                            <div class="form-group form-box">
                                <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address">
                                <i class="flaticon-mail-2"></i>
                            </div>
                            <div class="form-group form-box">
                                <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                                <i class="flaticon-password"></i>
                            </div>

                            <div class="input-container">

                                <div class="form-group form-box">
                                    <input type="date" name="datenaiss" class="form-control" placeholder="Date of birth" aria-label="Date of birth">
                               
                                </div>
                                <div class="form-group form-box">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" aria-label="Phone">
                                    <i class="flaticon-phone"></i>

                                </div>

                                </div>
                               

                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md btn-theme " id="loginbtn">Register</button>
                            </div>
                            <p class="text">Already a member?<a href="login-2.php"> Login here</a></p>
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
<script src="registre.js"></script>


</body>

</html>