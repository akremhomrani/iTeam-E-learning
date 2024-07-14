<?php
session_start();
include ('../connection.php'); // Ensure connection.php correctly establishes $conn

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$role = null;

if ($loggedin) {
    $id = $_SESSION['id ']; // Make sure this is set when the user logs in

    // Fetch the user's role
    $stmt = $conn->prepare("SELECT role FROM user WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($role);
    $stmt->fetch();
    $stmt->close();


    $stmtModules = $conn->prepare("SELECT COUNT(*) FROM module");
    $stmtModules->execute();
    $stmtModules->bind_result($totalModules);
    $stmtModules->fetch();
    $stmtModules->close();

    $stmtUsers = $conn->prepare("SELECT COUNT(*) FROM user");
    $stmtUsers->execute();
    $stmtUsers->bind_result($totalUsers);
    $stmtUsers->fetch();
    $stmtUsers->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">



    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dash.css">
    <link rel="stylesheet" href="../header/header.css">
<style>
    
/*FOOTER*/
footer {
  color: #E5E8EF;
  background: linear-gradient(to right, #85152E, #08304E);
  padding: 50px 0;
}

footer .footer-container {
  max-width: 1300px;
  margin: auto;
  padding: 0 20px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-wrap: wrap-reverse;
}

footer .social-media img {
  width: 22px;
}

footer .logo {
  width: 180px;
  color: #fff;
}

footer .social-media a {
  margin-right: 10px;
  font-size: 22px;
  text-decoration: none;
}

footer .right-col h1 {
  font-size: 26px;
}

footer .border {
  width: 100px;
  height: 4px;
  background: linear-gradient(to right, #FA4B37, #DF2771);
  margin: 2px;
}

footer .newsletter-form {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
}

footer input::placeholder {
  color: white !important;
}

footer .txtb {
  flex: 1;
  padding: 18px 40px;
  font-size: 16px;
  background: #343A40;
  border: none;
  font-weight: 700;
  outline: none;
  border-radius: 5px;
  min-width: 260px;
  margin-top: 20px;
  color: white;
}

footer .btn {
  margin-top: 20px;
  padding: 18px 40px;
  font-size: 16px;
  color: #f1f1f1;
  background: linear-gradient(to right, #740e02, #bc074f);
  border: none;
  font-weight: 700;
  outline: none;
  border-radius: 5px;
  margin-left: 20px;
  cursor: pointer;
  transition: opacity .3s linear;
}

footer .btn:hover {
  opacity: .7;
}

/*For Responsive Website*/
@media screen and (max-width: 960px) {
	.footer-container {
		max-width: 600px;
	}
	.right-col {
		width: 100%;
		margin-bottom: 60px;
	}
	.left-col {
		width: 100%;
		text-align: center;
	}
	.social-media {
		display: flex;
		justify-content: center;
	}
}

@media screen and (max-width: 700px) {
	footer .btn{
		margin: 0;
		width: 100%;
		margin-top: 20px;
	}
}
@media screen and (max-width: 1366px) {
	.search {
		display: none;
		margin-bottom: 10px;
	}
}

@media screen and (max-width: 1000px) {
	.nav ul, .nav .search {
		display: none;
	}
	.nav #learned-logo {
		transition: 1s ease;
		margin-left: 40%;
		transform: scale(1.5);
	}
	.nav ul li{
		width: 100%;
		margin-bottom: 5px;
	}
	.nav .switch-tab {
		visibility: visible;
	}
	.nav .check-box {
		visibility: visible;
	}
	.search {
		visibility: visible;
		margin: 30px;
		margin-top: 0px;
	}
}

</style>
</head>

<body>
    <header id="header">
    <div class="fixe" >
  
  
  <div class="navbar navbar-fixed-top">
    <a href="../index.php">
      <img src="../images/icon/logo.PNG" class="loh" alt="Image 1">
    </a>
    <ul >
    <li  class="info"><a class="get-started" href="../index.php"><i class="fa fa-user" aria-hidden="true"></i> Home</a></li>
      <li  class="info">
        <a class="get-started" href="<?php echo $loggedin ? '../logout.php' : '../login-2.php'; ?>">
        <i class="fa fa-user" aria-hidden="true"></i> 
        <?php echo $loggedin ? 'Logout' : 'Login'; ?>
    </a>
</li>
      
                    
                </a>
    </ul>
  </div>
</div>
        <div class="container">
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <a href="users.php">
                        <div class="card bg-pattern">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-archive text-primary h4 ml-3"></i>
                                </div>
                                <h5 class="font-size-20 mt-0 pt-1"><?php echo $totalUsers; ?></h5>
                                <p class="text-muted mb-0">Total Users</p>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-xl-3 col-md-6">
                    <a href="Modules.php">
                        <div class="card bg-pattern">
                            <div class="card-body">
                                <div class="float-right">
                                    <i class="fa fa-th text-primary h4 ml-3"></i>
                                </div>
                                <h5 class="font-size-20 mt-0 pt-1"><?php echo $totalModules; ?></h5>
                                <p class="text-muted mb-0">Total Courses</p>
                            </div>
                        </div>
                    </a>
                </div>


            </div>


        </div>

    </header>
    <footer>
	<div class="footer-container">
		<div class="left-col">
			<img src="../images/icon/logo.PNG" style="width: 200px;">
			<div class="logo"></div>
			<div class="social-media">
				<a href="https://www.facebook.com/iteam.university.tn"><img src="../images/icon\fb.png"></a>
				<a href="https://www.instagram.com/iteamuniversity/?hl=fr"><img src="../images/icon\insta.png"></a>
				<a href="#"><img src="../images/icon\tt.png"></a>
				<a href="https://www.youtube.com/channel/UCQXhW-RMeABXLzuirSk7shw"><img src="../images/icon\ytube.png"></a>
				<a href="https://www.linkedin.com/in/iteam-university-0916621a6/"><img src="../images/icon\linkedin.png"></a>
			</div><br><br>
			<p class="rights-text">Tous droits réservés © iTeam University 2023
			</p>
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
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">



    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript">

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>

</html>