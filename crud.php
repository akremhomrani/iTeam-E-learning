<?php
session_start();
include('connection.php'); // Ensure connection.php correctly establishes $conn

$loggedin = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$role = null;

if ($loggedin) {
    $id  = $_SESSION['id ']; // Make sure this is set when the user logs in

    // Fetch the user's role
	$stmt = $conn->prepare("SELECT role FROM user WHERE id = ?");
	$stmt->bind_param("i", $id );
	$stmt->execute();
	$stmt->bind_result($role);
	$stmt->fetch();
	$stmt->close();
	
}
?>

<!DOCTYPE html>
<html>

<head>
	<link rel="shortcut icon" type="png" href="images/icon/logo.PNG">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Comaptible" content="IE=edge">
	<title>iTeam E-Learning</title>
	<meta name="desciption" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

	

		
		<link rel="stylesheet" type="text/css" href="style.css">
		
		<script type="text/javascript" src="script.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script>
			        console.log("User ID: <?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : 'Not set'; ?>");
        console.log("Logged in: <?php echo $loggedin ? 'true' : 'false'; ?>");
        console.log("Role: <?php echo $role; ?>");
			$(window).on('scroll', function(){
				  if($(window).scrollTop()){
					$('nav').addClass('black');
				  }else {
				$('nav').removeClass('black');
			  }
			})

		</script>

</head>

<body>
	<header id="header">
		<nav>
			<div class="logo"><img src="images/icon/logo.png" alt="logo"></div>
			<ul>
				<li><a class="active" href="">Home</a></li>
				<li><a  href="dashboard Admin/dashboard.php">dash</a></li>
				<li><a href="#about_section">About</a></li>
				<li><a href="#team_section">Team</a></li>
				<li><a href="#services_section">Services</a></li>
				<li><a href="#contactus_section">Contact</a></li>
		


				<ul>
    <div class="srch">
        <input type="text" class="search" placeholder="Search here...">
        <img src="images/icon/search.png" alt="search">
    </div>
	<?php if ($loggedin): ?>
                    <?php if ($role === 'admin'): ?>
                        <a class="get-started" href="dashboard Admin/dashboard.php">Dashboard</a>
                    <?php else: ?>
                        <a class="get-started" href="./profile/profile.php">Profile</a>
                    <?php endif; ?>
                <?php endif; ?>
	<a class="get-started" href="<?php echo $loggedin ? 'logout.php' : 'login-2.php'; ?>">
                    <?php echo $loggedin ? 'Logout' : 'Login'; ?>
                </a>
           

			<img src="images/icon/menu.png" class="menu" onclick="sideMenu(0)" alt="menu">
		</nav>

	</header>
