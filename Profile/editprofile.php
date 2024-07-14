<?php

include('../connection.php');


session_start();

if (!isset($_SESSION['email'])) {

    header("../login-2.php");

    exit();
}

$email = $_SESSION['email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['pass'], $_POST['datenaiss'], $_POST['phone'], $_POST['image'])) {
        $nom = mysqli_real_escape_string($conn, $_POST['nom']);
        $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
        $new_email = mysqli_real_escape_string($conn, $_POST['email']);
        $password = mysqli_real_escape_string($conn, $_POST['pass']);
        $datenaiss = mysqli_real_escape_string($conn, $_POST['datenaiss']);
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $image = mysqli_real_escape_string($conn, $_POST['image']);

        // Check if password is empty, if so, don't update it
        $hash = !empty($password) ? password_hash($password, PASSWORD_DEFAULT) : '';

        // Build the SQL query dynamically based on the fields that have been modified
        $sql = "UPDATE user SET ";
        $updates = [];
        if (!empty($nom)) $updates[] = "nom='$nom'";
        if (!empty($prenom)) $updates[] = "prenom='$prenom'";
        if (!empty($new_email)) $updates[] = "email='$new_email'";
        if (!empty($hash)) $updates[] = "password='$hash'";
        if (!empty($datenaiss)) $updates[] = "datenaiss='$datenaiss'";
        if (!empty($phone)) $updates[] = "phone='$phone'";
        if (!empty($image)) $updates[] = "image='$image'";
        $sql .= implode(', ', $updates);
        $sql .= " WHERE email='$email'";

        // Execute the SQL query
        $result_update = mysqli_query($conn, $sql);

        if ($result_update) {
            echo '<script>
                    alert("Your information has been updated successfully.");
                    window.location.href = "../Profile/profile.php";
                </script>';
        } else {
            echo '<script>
                    alert("Error occurred while updating your information.");
                    window.location.href = "update-2.php";
                </script>';
        }
    }
}

// Retrieve user information based on email
$sql = "SELECT * FROM user WHERE email='$email'";
$result_user = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result_user);

?>
<!DOCTYPE html>
<html lang="zxx">




<head>
    <title>iTeamElearning - Update</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <!-- External CSS libraries -->
    

    <link type="text/css" rel="stylesheet" href="../assets/css/bootstrap.min.css">
<link type="text/css" rel="stylesheet" href="../assets/fonts/font-awesome/css/font-awesome.min.css">
<link type="text/css" rel="stylesheet" href="../assets/fonts/flaticon/font/flaticon.css">
<link type="text/css" rel="stylesheet" href="../assets/css/style.css">
<link rel="stylesheet" type="text/css" id="style_sheet" href="../assets/css/skins/default.css">
<link rel="shortcut icon" href="../images/icon/logo.png" type="image/x-icon" >


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
                       
                       <img src="../images/creator/<?php echo $row['image']; ?>" >
                 
               </div>
                    
                    <h3 >Edit Your Account</h3>
                    <div class="login-inner-form">
                    <form id="register"  method="POST">
                        <div id="error-container" style="color: #dc3545;"></div>


                        <div class="input-container">

                            <div class="form-group form-box">
                                <input type="text" name="nom" class="form-control" placeholder="First Name" aria-label="First Name" id="nom" value="<?php echo $row['nom']; ?>">
                                <i class="flaticon-user"></i>
                            </div>
                            <div class="form-group form-box">
                                <input type="text" name="prenom" class="form-control" placeholder="Last Name" aria-label="Last Name" value="<?php echo $row['prenom']; ?>" id="prenom">
                                <i class="flaticon-user"></i>
                            </div>

                            </div>
                            <div class="form-group form-box">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" aria-label="Email Address" value="<?php echo $row['email']; ?>" readonly>
                                <i class="flaticon-mail-2"></i>
                            </div>
                            <div class="form-group form-box">
                                <input type="password" name="pass" class="form-control" autocomplete="off" placeholder="Password" aria-label="Password">
                                <i class="flaticon-password"></i>
                            </div>

                            <div class="input-container">

                                <div class="form-group form-box">
                                    <input type="date" name="datenaiss" class="form-control" placeholder="Date of birth" aria-label="Date of birth" value="<?php echo $row['datenaiss']; ?>">
                               
                                </div>
                                <div class="form-group form-box">
                                    <input type="text" name="phone" class="form-control" placeholder="Phone" aria-label="Phone"  value="<?php echo $row['phone']; ?>">
                                    <i class="flaticon-phone"></i>

                                </div> </div>
                                <div class="form-group form-box">
                                    <input type="file" name="image" class="form-control" placeholder="image" aria-label="image"  value="<?php echo $row['image']; ?>">
                                    <i class="flaticon-phone"></i>

                                </div>
                               
                               

                            <div class="form-group mb-0">
                                <button type="submit" class="btn-md btn-theme " id="loginbtn">Update</button>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/jquery.min.js"></script>
<script src="../assets/js/popper.min.js"></script>
<script src="../assets/js/bootstrap.bundle.min.js"></script>
<script src="../registre.js"></script>


</body>

</html>
