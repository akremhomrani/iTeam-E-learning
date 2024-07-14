<?php
session_start();



include('../connection.php'); 

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
if (!isset($_SESSION['loggedin']) || empty($_SESSION['email'])) {
    header('Location: ../404.php');
    exit();
}
// Check if the user has admin role
if ($_SESSION['role'] !== 'admin') {
    header('Location: ../404.php');
    exit();
}
?>
<?php
session_start();
include ('../connection.php');
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
// Check if form is submitted for creating or updating a module
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['title']) && isset($_POST['content']) && isset($_POST['description']) && isset($_POST['user_email'])) {
        $title = $conn->real_escape_string($_POST['title']);
        $content = $conn->real_escape_string($_POST['content']);
        $description = $conn->real_escape_string($_POST['description']);
        $user_email = $conn->real_escape_string($_POST['user_email']);

        // Check if user exists and is a teacher
        $user_query = "SELECT id FROM user WHERE email = '$user_email' AND role = 'teacher'";
        $user_result = $conn->query($user_query);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            $user_id = $user_row['id'];

            // Insert new module into the database
            $sql = "INSERT INTO module (title, contenu, description, dateadd, created_by) 
                    VALUES ('$title', '$content', '$description', CURDATE(), $user_id)";

            if ($conn->query($sql) === TRUE) {
                echo '<script>
                alert("Module added successfully!");
                window.location.href = "modules.php";
                </script>';
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo '<script>
            alert("User not found or is not a teacher.");
            window.location.href = "modules.php";
            </script>';
            exit();
        }
    }
}

// Check if the request is to update an existing module
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_module_id']) && isset($_POST['edit_title']) && isset($_POST['edit_content']) && isset($_POST['edit_description'])) {
    $moduleId = $conn->real_escape_string($_POST['edit_module_id']);
    $title = $conn->real_escape_string($_POST['edit_title']);
    $content = $conn->real_escape_string($_POST['edit_content']);
    $description = $conn->real_escape_string($_POST['edit_description']);

    // Update the module in the database
    $sql = "UPDATE module SET title = '$title', contenu = '$content', description = '$description' WHERE idmod = $moduleId";

    if ($conn->query($sql) === TRUE) {
        echo '<script>
                alert("Your information has been updated successfully.");
                window.location.href = "../dashboard Admin/Modules.php";
            </script>';
    } else {
        echo json_encode(array("success" => false, "error" => $conn->error)); // Return error response
    }
    exit(); // Terminate the script after processing form submission
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="png" href="../images/icon/logo.PNG">
    <title>Display Modules</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="modules.css">

</head>
<style>

/* navbar transparent */
.fixe .navbar{
    width:100%;
    height: 75px;
    margin: auto;
   display: flex;
    align-items: center;
    justify-content: space-between;
  
  }

  /* items design */
  .fixe  .navbar ul li{
    list-style: none;
    display: inline-block;
    position: relative;
  }
  
  /* linkes design */
  .fixe .navbar ul li a{
    text-decoration: none;
    color: black;
    text-transform: uppercase;
  }
  
  /* nzido star ta7t items */
  .fixe .navbar ul li::after{
  content:'' ;
  height: 3px;
  width: 0;
  background: #85152E;
  position: absolute;
  left: 0;
  bottom: -5px;
  transition: 0.5s;
  }
  
  .fixe .navbar ul li:hover::after{
  width: 50%;
  }
  .fixe  .navbar ul li i{
    color: #85152E; 
  }

  /* Styles pour la navigation mobile (dropdown) */
  @media (max-width: 768px) {
    .navbar ul {
      display: none; /* Masquez la liste des éléments de la navbar */
    }
  }
  
  .fixe {
padding-bottom: 90px;
margin-top: -50px;
    width: 100%;
    justify-content: space-between;
    z-index: 100;
  }
  
  /* Media query for smaller screens */
  @media screen and (max-width: 1024px) {
    .fixe {
      justify-content: center;
    }
  }
  
  /* Media query for larger screens */
  @media screen and (min-width: 250px) {
    .fixe {
      justify-content: space-between;
    }
  }
  .fixe  .navbar {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
 
    left: 0;
    z-index: 100;
    background-color:#001935b4;
    padding: 10px;
    position: fixed;
    margin-top: 0rem;
  }
  .fixe .navbar .loh{
    width: 180px;

  }
 
  .fixe  .navbar-right {
    display: flex;
    align-items: center;
  }
  
  .fixe  .navbar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
  }
  
  .fixe  .navbar ul li {
    margin-right: 20px;
  }
  
  .fixe  .navbar ul li a {
    text-decoration: none;
    color: #fff;
    text-transform: uppercase;
  }
  
 </style>
<body>
    

<div class="fixe" >

  <div class="navbar navbar-fixed-top">
    <a href="../index.php">
      <img src="../images/icon/logo.PNG" class="loh" alt="Image 1">
    </a>
  
  </div>
</div>
    <?php
    $sql = "SELECT * FROM module";
    $result = $conn->query($sql);
    ?>

    <button onclick="openModal()" class="buttonadd">Create New Module</button>
    <!-- create module -->
    <div id="myModal" class="modal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create New Module</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="py-1">
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input type="text" id="title" name="title" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Content</label>
                                    <textarea id="content" name="content" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea id="description" name="description" class="form-control"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Email Formateur</label>
                                    <input type="email" id="user_email" name="user_email" class="form-control">
                                </div>
                             
                             
                            </div>
                        </div>
                        <div class="row">
                            <div class="col d-flex justify-content-end">
                                <button class="btn btn-primary" type="submit">Create Module</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="editModal" class="modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Module</h5>
                    <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span>
                </button>
                </div>
                <div class="modal-body">
                    <div class="py-1">

            <form id="editForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

                <input type="hidden" id="edit_module_id" name="edit_module_id">


                <div class="col">
                    <div class="form-group">
                        <label>Title</label>
                        <input type="text" id="edit_title" name="edit_title" class="form-control" required>
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        <label>Content</label>

                        <textarea id="edit_content" name="edit_content" class="form-control"></textarea>
                    </div>
                </div>



                <div class="col">
                    <div class="form-group">
                        <label>Description</label>

                        <textarea id="edit_description" name="edit_description" class="form-control"></textarea>
                    </div>
                </div>


             
                <button class="btn btn-primary" type="submit">Update Module</button>
                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </d>
        </div>
    </div>
    <?php
    if ($result->num_rows > 0) {
        $count = 0; // Initialize counter
        while ($row = $result->fetch_assoc()) {
            if ($count % 3 == 0) { // Start a new row for every 3 items
                if ($count > 0) { // Close the previous row
                    echo '</div>';
                }
                echo '<div class="row">'; // Start a new row
            }
            ?>
            <div class="col-md-4 my-3">
                <div class="card border-hover-primary hover-scale">
                    <div class="card-body">
                        <div class="text-primary mb-5">
                            <svg width="60" height="60" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"></rect>
                                    <path
                                        d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                        fill="currentColor"></path>
                                    <path
                                        d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                        fill="currentColor" opacity="0.3"></path>
                                </g>
                            </svg>

                            <div class="module-container">
                                <div class="module-title"><?php echo $row["title"]; ?></div>
                                <div class="module-content">
                                    <h6 class="font-weight-bold mb-3"><strong>Content:</strong> <?php echo $row["contenu"]; ?>
                                    </h6>
                                    <p class="text-muted mb-0"><strong>Description:</strong> <?php echo $row["description"]; ?>
                                    </p>
                                    <p class="text-muted mb-0"><strong>Date Added:</strong> <?php echo $row["dateadd"]; ?></p>
                                   
                                    <!-- Edit button -->
                                    <a href="#" onclick="openEditModal(<?php echo $row['idmod']; ?>)">Edit</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php
            $count++;
        }
        if ($count % 3 != 0) { // Close the last row if it was not completed
            echo '</div>';
        }
    } else {
        echo "No modules found.";
    }
    ?>

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
    <script>
        var modal = document.getElementById("myModal");
        var editModal = document.getElementById("editModal");
        var btn = document.querySelector("button");
        var span = document.getElementsByClassName("close")[0];

        btn.onclick = function () {
            modal.style.display = "block";
        }

        span.onclick = function () {
            modal.style.display = "none";
        }

        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function openModal() {
            modal.style.display = "block";
        }

        function closeModal() {
            modal.style.display = "none";
        }

        function closeEditModal() {
            editModal.style.display = "none";
        }

        function openEditModal(moduleId) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var moduleDetails = JSON.parse(this.responseText);
                    if (moduleDetails) {
                        document.getElementById("edit_module_id").value = moduleDetails.idmod;
                        document.getElementById("edit_title").value = moduleDetails.title;
                        document.getElementById("edit_content").value = moduleDetails.contenu;
                        document.getElementById("edit_description").value = moduleDetails.description;
                        editModal.style.display = "block";
                    } else {
                        alert("Module details not found.");
                    }
                }
            };
            xhr.open("GET", "edit_module.php?edit_module=" + moduleId, true);
            xhr.send();
        }
    </script>
</body>

</html>

<?php
$conn->close();
?>