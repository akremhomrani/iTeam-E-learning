

<!DOCTYPE html>
<html>
<head>
	<link rel="shortcut icon" type="png" href="../images/icon/logo.PNG">
	<title>Courses on iTeam E-Learning</title>
	<!-- <link rel="stylesheet" type="text/css" href="subjects.css"> -->
	<script type="text/javascript" src="../script.js"></script>
<style>
	@import url('https://fonts.googleapis.com/css?family=Montserrat:500&display=swap');
@import url('https://fonts.googleapis.com/css?family=Dancing+Script&display=swap');
@import url('https://fonts.googleapis.com/css?family=Open+Sans&display=swap');

* {
	box-sizing: border-box;
	margin: 0;
	padding: 0;
}
html {
	scroll-behavior: smooth;
}
body {
	background: #FFF;
	font-family: 'Open Sans', sans-serif;
}

/*SCROLLBAR Styling*/
::-webkit-scrollbar {
  width: 5px;
}
::-webkit-scrollbar-thumb {
  background: #FA4B37;
  border-radius: 5px;
}
::-webkit-scrollbar-thumb:hover {
  background: #DF2771; 
}

/*NAVIGATION BAR*/
.nav
{
	width: 100%;
	background-color: #fff;
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
	align-items: center;
	padding: 20px 2%;
	position: fixed;
	top: 0px;
	z-index: 10;
	box-shadow: 1px 1px 10px rgba(0,0,0,0.5);
}

.nav li, a, button
{
	float: left;
	font-family: "Montserrat", sans-serif;
	font-weight: 500;
	font-size: 13px;
	color: #2E3D49;
	display: block;
	text-decoration: none;
	text-align: center;
}

.nav ul li img {
	width: 20px;
	margin-right: 10px;
	transform: translateY(5px);
	padding-top: 5px;
}

.nav ul li 
{
	list-style: none;
	display: inline-block;
	padding: 0px 20px;
}

.nav ul li a
{
	transition: all 0.3s ease 0s;
}

.nav ul li a:hover
{
	color: #070378;
}

.nav button
{
	padding: 9px 25px;
	background: linear-gradient(to right, #740e02, #bc074f);
	color: #fff;
	border: none;
	border-radius: 5px;
	cursor: pointer;
	outline: none;
	transition: all 0.3s ease 0s;
}
#srchbtn {
	padding: 9px 20px;
}
#srchbtn img {
	width: 15px;
	filter: brightness(100);
}
.nav button:hover
{
	opacity: .9;
}
.nav .search
{
	float: right;
}
.nav .search .srch
{
	font-size: 13px;
	width: 300px;
	border: none;
	outline: none;
	border-bottom: 2px solid #FA4B37;
	padding: 9px;
}
.nav .search button
{
	margin-right: 5px;
	float: right;
	margin-left: 10px;
}
.nav .switch-tab {
	cursor: pointer;
	visibility: hidden;
}
.nav .switch-tab img {
	width: 20px;
}
.nav .check-box {
	cursor: pointer;
	visibility: hidden;
}

/*TITLE*/
.title {
	margin-top: 150px;
	margin-left: 100px;
}
.title span{
	font-weight: 700;
	font-family: 'Open Sans', sans-serif;
	font-size: 60px;
	color: #2E3D49;
}
.title .shortdesc {
	padding: 10px;
	font-family: 'Open Sans', sans-serif;
	font-size: 20px;
	color: #2E3D49;
	margin-bottom: 50px;
}

/*Quick Links*/
.course {
	display: grid;
	justify-content: center;
}

.cbox {
	display: inline-flex;
	flex-wrap: wrap;
	justify-content: center;
}
.cbox .det {
	height: 60px;
	margin: 10px;
	background: #fff;
	cursor: pointer;
	border-radius: 50px;
}
.cbox .det a{
	justify-content: space-around;
	width: 100%;
	padding: 20px;
	border-radius: 50px;
	border: 1px solid #FA4B37;
	font-size: 15px;
	color: #272529;
	font-family: cursive;
	text-decoration: none;
}

.cbox .det a:hover{
	background: linear-gradient(to right, #FA4B37, #DF2771);
	color: white;
}

.inbt {
	padding: 10px;
	font-family: 'Open Sans', sans-serif;
	font-size: 30px;
	color: #2E3D49;
	margin: 100px;
	margin-bottom: 50px;
}

/*COURSES AVAILABLE*/
.ccard {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
	align-items: center;
}
.ccardbox {
	display: flex;
	flex-wrap: wrap;
	justify-content: center;
}

.dcard {
	margin: 10px;
	width: 300px;
	height: 200px;
	background: linear-gradient(to right, #740e02, #bc074f);
	border-radius: 10px;
	box-shadow: 0 0 20px rgba(0,0,0,0.4);
}

.dcard .fpart {
	width: inherit;
	height: 150px;
	color: #000;
	text-align: left;
	overflow: hidden;
}
.dcard .fpart img {
	width: 100%;
	height: 100%;
}

.dcard .spart {
	padding: 10px;
	padding-right: 0px;
	color: #fff;
	text-align: left;
	cursor: pointer;
}
.dcard .spart img {
	width: 20px;
	margin-left: 170px;
	cursor: pointer;
	/* transform: rotate(180deg); */
}

.dcard:hover .fpart img{
	transition: .8s ease;
	transform: scale(1.2);
}

/*Small Titles for  Topics*/
.title2 {
	position: relative;
	padding-top: 150px;
	margin-left: 100px;
}
.title2 span{
	font-weight: 700;
	font-family: 'Open Sans', sans-serif;
	font-size: 30px;
	color: #2E3D49;
}
.title2 .shortdesc2 {
	padding: 10px;
	font-family: 'Open Sans', sans-serif;
	font-size: 15px;
	color: #2E3D49;
	margin-bottom: 10px;
}

/*Videos Section*/
.ccardbox2 {
	display: flex;
	justify-content: center;
	flex-wrap: wrap;
}

.dcard2 {
	margin: 20px;
	width: 300px;
	height: 160px;
	background: linear-gradient(to right, #450802, #9d0140);
	border-radius: 10px;
}
.dcard2:hover .fpart2 img {
	display: none;
}
.dcard2 .fpart2 { 
	width: inherit;
	height: 180px;
	background: #000;
	color: #000;
	text-align: left;
	border-top-right-radius: 100px;
	transform: translateY(-19px);
	box-shadow: 0 0 20px rgba(0,0,0,0.4);
	overflow: hidden;
}
.dcard2 .tag {
	position: relative;
	margin-left: 270px;
	top: 10px;
	color: #fff;
}
.dcard2 .fpart2 img {
	width: 100%;
	height: 100%;
}
.fpart2 iframe {
	height: inherit;
	width: inherit;
}

/*Watch Full Playlist*/
.click-me {
	justify-content: center;
	display: flex;
}
.click-me a {
	color: #000000;
	text-decoration: none;
	transition-duration: .5s;
	padding: 10px;
}
.click-me a:hover {
	background: #090265;
	color: #fff;
}

/*PROJECTS*/
.project-panel {
	/*background: #000;*/
	display: flex;
	flex-wrap: wrap;
	align-items: center;
	justify-content: center;
}
.project-card {
	width: 250px;
	/*height: 220px;*/
	background: #fff;
	margin-right: 10px;
	margin-bottom: 10px;
	border-radius: 5px;
	cursor: pointer;
	box-shadow: 2px 2px 10px rgba(0,0,0,0.3);
}
.project-card img {
	width: inherit;
	/*height: 140px;*/
}
.project-card:hover {
	transform: scale(1.2);
	transition: .5s ease;
}
.project-card:hover .download a{
	visibility: visible;
}
.project-card .info {
	padding: 10px;
}
.project-card .info h4 {
	color: #2E3D49;
}
.project-card .info p {
	font-size: 12px;
}
.download {
	margin-top: 10px;
	display: flex;
	justify-content: center;
}
.download a{
	padding: 5px 10px;
	color: #DF2771;
	font-size: .8em;
	visibility: hidden;
}
.download:hover a{
	transition: .5s ease;
	background: #DF2771;
	color: #fff;
}


/*Sample Papers*/

.sample {
	display: flex;
	align-items: center;
	flex-wrap: wrap;
	justify-content: space-around;
}
.lastSample {
	margin-bottom: 100px;
}
.sample ul {
	margin: 20px;
}

.sample ul li{
	padding: 28px;
	list-style: none;
}

.sample ul li a {
	color: #770f03;
	width: 300px;
	font-size: 20px;
}

/*Footer*/

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
	
<!-- NAVIGATION -->
	<header>
		<div class="nav" id="nav">
			<div id="learned-logo">
			<a href="../index.php"><img src="../images/icon/logo.png" style="width: 120px;"></a></div>
			<div class="switch-tab" id="switch-tab" onclick="switchTAB()"><img src="../images/icon/menu.png"></div>
			<ul id="list-switch">
				<li><a href="#cycleprepa"><img src="../images/courses/d1.png" class="icon">Cycle Préparatoire</a></li>
				<li><a href="#cycleing"><img src="../images/courses/paper.png" class="icon">Cycle ingénieur</a></li>
				<li><a href="#licences"><img src="../images/courses/computer.png" class="icon">Licences</a></li>
				<li><a href="#masters"><img src="../images/courses/data.png" class="icon">Masters</a></li>
				
			</ul>
			<div class="search" id="search-switch">
				<input type="search" placeholder="Search" class="srch"><button id="srchbtn"><img src="../images/icon/search.png"></button>
			</div>
		</div>
	</header>
	

<!-- MAIN Heading of Page -->
	<div class="title" >
		<span>Courses<br>on iTeam E-Learning</span>
		<div class="shortdesc">
			<p>Courses on iTeam E-Learning offer comprehensive <br>learning experiences tailored to diverse skill <br>levels and interests. </p>
		</div>
	
	</div>



	<div id="cycleprepa">
    <div class="title2">
        <span>Cycle Préparatoire</span>
    </div>
    <div class="ccard">
        <center>
            <div class="ccardbox">
                <div class="dcard">
                    <div class="fpart"><img src="../images/courses/cycleprepa.jpg"></div>
                    <a href="CyclePrepa/cycleprepa1.php" class="">
                        <div class="spart">1er année <img src="../images/icon/dropdown.png"></div>
                    </a>
                </div>
                <div class="dcard">
                    <div class="fpart"><img src="../images/courses/cycleprepa.jpg"></div>
                    <a href="CyclePrepa/cycleprepa2.php" class="<?php echo $level == '2eme année' ? 'current-level' : ''; ?>">
                        <div class="spart">2eme année <img src="../images/icon/dropdown.png"></div>
                    </a>
                </div>
                <div class="dcard">
                    <div class="fpart"><img src="../images/courses/cycleprepa.jpg"></div>
                    <a href="CyclePrepa/cycleprepa3.php" class="<?php echo $level == '3eme année' ? 'current-level' : ''; ?>">
                        <div class="spart">3eme année <img src="../images/icon/dropdown.png"></div>
                    </a>
                </div>
            </div>
        </center>
    </div>
  
</div>
<div id="cycleing">


	<div class="title2" >
		<span>
			Cycle ingénieur
		</span>
	</div>

	<div class="ccard" >
	<center>
		<div class="ccardbox" >
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/cycleing.jpg"></div>
				<a href="Cycleing/cycleing1.php"><div class="spart">1er année <img src="../images/icon/dropdown.png"></div></a>
			</div>
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/cycleing.jpg"></div>
				<a href="Cycleing/cycleing2.php"><div class="spart">2eme année <img src="../images/icon/dropdown.png"></div></a>
			</div>
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/cycleing.jpg"></div>
				<a href="Cycleing/cycleing3.php"><div class="spart">3eme année <img src="../images/icon/dropdown.png"></div></a>
			</div>
		</div>
		
		
	</center>
	</div>
</div>

<div id="licences">


	<div class="title2" >
		<span>
			Licences
		</span>
	</div>

	<div class="ccard" >
	<center>
		<div class="ccardbox" >
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/licences.jpg"></div>
				<a href="Licence/licence1.php"><div class="spart">1er année <img src="../images/icon/dropdown.png"></div></a>
			</div>
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/licences.jpg"></div>
				<a href="Licence/licence2.php"><div class="spart">2eme année <img src="../images/icon/dropdown.png"></div></a>
			</div>
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/licences.jpg"></div>
				<a href="Licence/licence3.php"><div class="spart">3eme année <img src="../images/icon/dropdown.png"></div></a>
			</div>
		</div>
		
		
	</center>
	</div>
</div>

<div id="masters">


	<div class="title2" >
		<span>
			Masters
		</span>
	</div>

	<div class="ccard" >
	<center>
		<div class="ccardbox" >
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/masters.png"></div>
				<a href="Masters/masters1.php"><div class="spart">1er année <img src="../images/icon/dropdown.png"></div></a>
			</div>
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/masters.png"></div>
				<a href="Masters/masters2.php"><div class="spart">2eme année <img src="../images/icon/dropdown.png"></div></a>
			</div>
			<div class="dcard">
				<div class="fpart"><img src="../images/courses/masters.png"></div>
				<a href="Masters/masters3.php"><div class="spart">3eme année <img src="../images/icon/dropdown.png"></div></a>
			</div>
		</div>
		
		
	</center>
	</div>

</div>


<!-- FOOTER -->
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
</body>
</html>