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
	<link rel="stylesheet" type="text/css" href="index.css">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

	<style>

	</style>

		
		<link rel="stylesheet" type="text/css" href="style.css">
		<script type="text/javascript" src="script.js"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<script>
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
			<div class="logo"><a href="index.php"><img src="images/icon/logo.png" alt="logo" href=""></a></div>
			<ul>
				<li><a class="active" href="#">Home</a></li>
				<li><a href="#about_section">About</a></li>
			
				<li><a href="#services_section">Courses</a></li>
				<li><a href="#contactus_section">Contact</a></li>
		


				<ul>

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
		<div class="head-container">
			<div class="quote">
				<p>The beautiful thing about learning is that nobody can take it away from you</p>
				<h5>Education is the process of facilitating learning, or the acquisition of knowledge, skills, values,
					beliefs, and habits. Educational methods include teaching, training, storytelling, discussion and
					directed research!</h5>

			</div>
			<div class="svg-image">
				<img src="images/extra/svg1.jpg" alt="svg">
			</div>
		</div>
		<div class="side-menu" id="side-menu">
			<div class="close" onclick="sideMenu(1)"><img src="images/icon/close.png" alt=""></div>
			<div class="logor"><img src="images/icon/logo.png" alt="logo"></div>
			<ul>
				<li><a href="#about_section">About</a></li>
				<li><a href="#portfolio_section">Portfolio</a></li>
				<li><a href="#team_section">Team</a></li>
				<li><a href="#services_section">Services</a></li>
				<li><a href="#contactus_section">Contact</a></li>
				<li><a href="#feedBACK">Feedback</a></li>
			</ul>
		</div>
	</header>


	<div class="title">
		<span>Formations on iTeam E-Learning</span>
	</div>
	<br><br>
	<div class="course">
		<center>
			<div class="cbox">
				<div class="det"><img src="images/courses/book.png">Cycle Préparatoire
				</div>
				<div class="det"><img src="images/courses/d1.png">Cycle ingénieur
				</div>
				<div class="det"><img src="images/courses/paper.png">Licences</div>
				<div class="det"><img src="images/courses/paper.png">Masters</div>

			</div>
			<!-- <div class="cbox">
				<div class="det"><img src="images/courses/book.png">HTML
				</div>
				<div class="det"><img src="images/courses/d1.png">CSS
				</div>
				<div class="det"><img src="images/courses/paper.png">C++</div>
				<div class="det"><img src="images/courses/paper.png">PYTHON</div>
				<div class="det"><img src="images/courses/d1.png">Daily Quiz</div>
			</div> -->
		</center>
		<!-- <div class="cbox">
			<div class="det"><img src="images/courses/computer.png">Computer
					Courses</div>
			
		</div> -->
	</div>



	<div class="diffSection" id="about_section">
		<center><p style="font-size: 50px; padding: 100px">About</p></center>
		<div class="about-content">
				<div class="side-image">
					<img class="sideImage" src="images/extra/e3.jpg">
				</div>
				<div class="side-text">
					<h2>What you think about us ?</h2>
<p>Share knowledge in a caring environment and a Win Win spirit to improve your career, while enjoying the pleasure of learning and entrepreneurship.

Train the leaders of tomorrow, collaborate as a Team to better face the challenges of a constantly changing world; together we can achieve more!

I appreciate the fact that at iTeam I am valued at my true value within the framework of a serious academic approach oriented towards market requirements in both “hard skills” and “soft skills”.</p>				</div>
		</div>
	</div>


	<!-- SERVICES -->
	<div class="service-swipe">
		<div class="diffSection" id="services_section">
			<center>
				<p style="font-size: 50px; padding: 100px; padding-bottom: 40px; color: #fff;">Courses</p>
			</center>
		</div>
		<a href="subjects/computer_courses.php">
			<div class="s-card"><img src="images/icon/computer-courses.png">
				<p>Courses</p>
			</div>
		</a>
		<!-- <a href="./profile/addcours.php">
			<div class="s-card"><img src="images/icon/brainbooster.png">
				<p>Add your own Documents</p>
			</div>
		</a> -->
	
		<!-- <a href="courses.html">
			<div class="s-card"><img src="images/icon/papers.jpg">
				<p>Our Famous Courses</p>
			</div>
		</a> -->
	
		<!-- <a href="#contactus_section">
			<div class="s-card"><img src="images/icon/discussion.png">
				<p>Discussion with Our Tutors & Mentors</p>
			</div>
		</a> -->
		<a href="Teacher.php">
			<div class="s-card"><img src="images/icon/q1.png">
				<p>Our Teacher</p>
			</div>
		</a>
	
	</div>
	<!-- Reviews by Students -->
	<div id="makeitfull">
		<a href="#review_section"><img src="images/icon/makeitfull.png"></a>
	</div>
	<div class="review">
    <div class="diffSection" id="review_section">
        <center>
            <p style="font-size: 40px; padding: 100px; padding-bottom: 40px; color: #2E3D49;">What the Students Say
                About Us?</p>
        </center>
    </div>
	<div class="rev-container" id="feedbackCarousel">
    <?php
    include "connection.php";
    $sql = "SELECT * FROM feedback ORDER BY idfeed DESC LIMIT 4";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $feedbackName = $row['firstname'];
            $feedbackContent = $row['message'];
            $feedbackEmail = $row['email'];
            
            // Fetching user's image and level
            $userDataSql = "SELECT * FROM user WHERE email = '$feedbackEmail'";
            $userDataResult = mysqli_query($conn, $userDataSql);
            $userData = mysqli_fetch_assoc($userDataResult);
            $userImage = $userData['image'];
    
			$prenom = $userData['prenom'];
    ?>
            <div class="rev-card" style="display: none;">
                <div class="identity">
                    <img src="images/creator/<?php echo $userImage; ?>">
                    <p><?php echo $feedbackName; ?>  <?php echo $prenom; ?></p>
                    <!-- <h6><?php echo $userLevel; ?>    <?php echo $userformtaion; ?> </h6>  -->
              
                </div>
                <div class="rev-cont">
                    <p id="title">Review:</p>
                    <p id="content">
                        <?php echo $feedbackContent; ?>
                    </p>
                </div>
            </div>
    <?php
        }
    } 
    
    ?>
</div>


<!------************** Reviews by Students *******************---------->	
<!-- Add this modal code to your HTML -->


	<!-- CONTACT US -->
	<div class="diffSection" id="contactus_section">
		<center>
			<p style="font-size: 50px; padding: 100px">Contact Us</p>
		</center>
		<div class="csec"></div>
		<div class="back-contact">
			<div class="cc">
            <form action="contact_form_handler.php" method="post">
					<label>First Name <span class="imp">*</span></label><label style="margin-left: 185px">Last Name
						<span class="imp">*</span></label><br>
					<center>
						<input type="text" name="fname" style="margin-right: 10px; width: 175px" required="required"><input
							type="text" name="lname" style="width: 175px" required="required"><br>
					</center>
					<label>Email <span class="imp">*</span></label><br>
					<input type="email" name="email" style="width: 100%" required="required"><br>
					<label>Message <span class="imp">*</span></label><br>
					<input type="text" name="message" style="width: 100%" required="required"><br>
					<label>Additional Details</label><br>
					<textarea name="additional"></textarea><br>
					<button type="submit" id="csubmit">Send Message</button>
				</form>
			</div>
		</div>
	</div>


	<!-- FEEDBACK -->
	<div class="title2" id="feedBACK">
		<span>Give Feedback</span>
		<div class="shortdesc2">
			<p>Please share your valuable feedback to us</p>
		</div>
	</div>

	<div class="feedbox">
		<div class="feed">
		<form id="feedbackForm" action="submit_feedback.php" method="post">
			<input type="hidden" name="userId" value="<?php echo $loggedInUserId; ?>">
        	<input type="hidden" name="userName" value="<?php echo $loggedInUserName; ?>">
        	<input type="hidden" name="userEmail" value="<?php echo $loggedInUserEmail; ?>">
				
				<label>Your Name</label><br>
				<input type="text" name="firstname" id="firstname" class="fname" required="required"><br>
				<label>Email</label><br>
				<input type="email" name="email" id="email" required="required"><br>
				<label>Additional Details</label><br>
				<textarea name="message" id="message"></textarea><br>
				<button type="submit" id="csubmit">Send Message</button>
			</form>
		</div>
	</div>

	<!-- Sliding Information -->
	<div class="title-container">
		<div class="line"></div>
		<div class="title-text">Our partners</div>
		<div class="line"></div>
	</div>
	<marquee style=" margin-bottom: 20px;" direction="left" onmouseover="this.stop()" onmouseout="this.start()"
		scrollamount="20">
		<div class="marqu">
			<img src="images/partener/200-2001206_cisco-cisco-high-res-logo.png" alt="">
			<img src="images/partener/microsoft-80659_1280.png" alt="">
			<img src="images/partener/Oracle-Logo.png" alt="">
			<img src="images/partener/png-clipart-vmware-logo-icons-logos-emojis-tech-companies.png" alt="">
		</div>
	</marquee>

	<!-- FOOTER -->
	<footer>
		<div class="footer-container">
			<div class="left-col">
				<img src="images/icon/logo.PNG" style="width: 200px;">
				<div class="logo"></div>
				<div class="social-media">
					<a href="#"><img src="images/icon\fb.png"></a>
					<a href="#"><img src="images/icon\insta.png"></a>
					<a href="#"><img src="images/icon\tt.png"></a>
					<a href="#"><img src="images/icon\ytube.png"></a>
					<a href="#"><img src="images/icon\linkedin.png"></a>
				</div><br><br>
				<p class="rights-text">Tous droits réservés © iTeam University 2023
				</p>
				<br>
				<p><img src="images/icon/location.png"> iTeam University <br>85-87 Rue Palestine 1002 Tunis</p>
				<br>
				<p><img src="images/icon/phone.png"> (216) 71 781 081<br><img src="images/icon/mail.png">&nbsp;
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const feedbackCards = document.querySelectorAll(".rev-card");
        let currentIndex = 0;

        function showFeedback(index) {
            feedbackCards.forEach((card, i) => {
                if (i === index) {
                    card.style.display = "block";
                } else {
                    card.style.display = "none";
                }
            });
        }

        function nextFeedback() {
            currentIndex++;
            if (currentIndex >= feedbackCards.length) {
                currentIndex = 0;
            }
            showFeedback(currentIndex);
        }

        setInterval(nextFeedback, 500); // Change feedback every 5 seconds
    });
</script>
</body>

</html>