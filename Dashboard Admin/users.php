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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="user.css">
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
		<nav>
			<div class="logo">
            <a href="../index.php"><img src="../images/icon/logo.png" alt="logo"></a></div>
			<ul>
				<li><a  href="../index.php">Home</a></li>
		
				<li><a href="../subjects/computer_courses.php">Courses</a></li>
			
		


				<ul>

	<?php if ($loggedin): ?>
                    <?php if ($role === 'admin'): ?>
                        <a class="get-started" href="dashboard.php">Dashboard</a>
                    <?php else: ?>
                        <a class="get-started" href="../profile/profile.php">Profile</a>
                    <?php endif; ?>
                <?php endif; ?>
                <a class="get-started" href="<?php echo $loggedin ? '../logout.php' : '../login-2.php'; ?>">
      
        <?php echo $loggedin ? 'Logout' : 'Login'; ?>
    </a>

			
		</nav>
             


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div class="container">   
 <button class="btn btn-block" type="button" data-toggle="modal" data-target="#user-form-modal" style="
	background-color: #85152E; color:#fff">New
        User</button>
        <div class="table-responsive table-lg mt-3">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th class="align-top">
                            
                        </th>
                        <th>Photo</th>
                        <th class="max-width">First Name</th>
                        <th class="max-width">Last Name</th>
                        <th class="sortable">Email</th>
                        <th> Phone</th>
                        <th> Status</th>
                        <th>Actions</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Start counter variable
                    $counter = 1;
                    ?>
                    <?php
                    $sql = "SELECT * FROM `user`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <tr>
                            <td class="align-middle"><?php echo $counter++; ?></td>

                            <td class="align-middle text-center">
                                <img src="../images/creator/<?php echo $row['image']; ?>" alt=""
                                    class="bg-light d-inline-flex justify-content-center align-items-center align-top"
                                    style="width: 35px; height: 35px; border-radius: 3px;">

                            </td>
                            <td class="text-nowrap align-middle"><?php echo $row["nom"] ?></td>
                            <td class="text-nowrap align-middle"><?php echo $row["prenom"] ?></td>
                            <td class="text-nowrap align-middle"><span><?php echo $row["email"] ?></span></td>
                            <td class="text-nowrap align-middle"><span><?php echo $row["phone"] ?></span></td>


                            <td class="text-center align-middle">
                                <?php if ($row['status'] == 'active'): ?>
                                    <i id="toggle-<?php echo $row['id']; ?>"
                                        class="fa fa-fw text-success cursor-pointer fa-toggle-on"></i>
                                <?php else: ?>
                                    <i id="toggle-<?php echo $row['id']; ?>"
                                        class="fa fa-fw text-danger cursor-pointer fa-toggle-off"></i>
                                <?php endif; ?>
                            </td>
                            <td class="text-center align-middle">
                                <div class="btn-group align-top">
                                <?php
$email = $row["email"]; 
$firstName = $row["nom"]; 
?>

<button class="btn btn-sm btn-outline-secondary badge edit-btn" type="button"
    data-toggle="modal" data-target="#user-form-edit"
    data-id="<?php echo $row["id"] ?>"
    data-nom="<?php echo $row["nom"] ?>"
    data-prenom="<?php echo $row["prenom"] ?>"
    data-email="<?php echo $row["email"] ?>"
    data-datenaiss="<?php echo $row["datenaiss"] ?>"
    data-phone="<?php echo $row["phone"] ?>"
    data-status="<?php echo $row["status"] ?>"
>
    Edit
</button>


                                    <button class="btn btn-sm btn-outline-secondary badge delete-btn" type="button"
                                        data-bs-toggle="modal" data-bs-target="#confirmDeleteModal"
                                        data-id="<?php echo $row["id"] ?>">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </div>
                            </td>

                        </tr>
                        <?php
                    }
                    ?>



                </tbody>
            </table>
        </div>
    </div>
    </header>
    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this user?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Delete</button>
                </div>
            </div>
        </div>
    </div>


    
<!-- EDIT user -->
<div class="modal fade" role="dialog" tabindex="-1" id="user-form-edit">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-1">
                        <form id="editUserForm" method="post" enctype="multipart/form-data" action="edit_user.php">
                            <input type="hidden" name="user_id" id="user_id" value="">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input class="form-control" type="text" name="nom" id="nom" placeholder="First Name" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input class="form-control" type="text" name="prenom" id="prenom" placeholder="Smith" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="email" readonly name="email" id="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="form-control" type="text" name="phone" id="phone" placeholder="+21656789" required>
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input class="form-control" type="date" name="datenaiss" id="datenaiss">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Roles</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="admin" id="admin" name="role" <?php echo ($role == 'admin') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="admin">Admin</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Student" id="Student" name="role" <?php echo ($role == 'Student') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="Student">Student (Student)</label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="teacher" id="teacher" name="role" <?php echo ($role == 'teacher') ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="teacher">Teacher (Enseignant)</label>
                                            </div>
                                        </div>
                                    </div>

     
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="active" id="active" name="status" checked>
                                                    <label class="form-check-label" for="active">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Not active" id="Not active" name="status">
                                                    <label class="form-check-label" for="Not active">Not Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                           
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button id="editUserBtn" class="btn btn-primary" type="submit" name="submit">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
</div>





    <!-- Create user -->
    <div class="modal fade" role="dialog" tabindex="-1" id="user-form-modal">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create User</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="py-1">
                        <form id="createUserForm" method="post" action="create_user.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input class="form-control" type="text" name="first_name"
                                                    placeholder="John" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input class="form-control" type="text" name="last_name"
                                                    placeholder="Smith" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Email</label>
                                                <input class="form-control" type="email" name="email"
                                                    placeholder="user@gmail.com" required>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Phone</label>
                                                <input class="form-control" type="text" name="phone"
                                                    placeholder="123456789" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Password</label>
                                                <input class="form-control" type="password" name="password"
                                                    placeholder="••••••" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Date of Birth</label>
                                                <input class="form-control" type="date" name="datenaiss">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Roles</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="admin"
                                                        id="role_admin" name="role">
                                                    <label class="form-check-label" for="role_admin">Admin</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Student"
                                                        id="role_Student" name="role">
                                                    <label class="form-check-label" for="Student">Student
                                                        (etudiant)</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="teacher"
                                                        id="role_teacher" name="role">
                                                    <label class="form-check-label" for="role_teacher">Teacher
                                                        (Enseignant)</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                <label>Group</label>
                <select class="form-control" name="group">
                    <?php
                    // Fetch groups from the database
                    $sql = "SELECT * FROM `group`";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<option value='" . $row['id_g'] . "'>" . $row['formation'] . " " . $row['year'] . "</option>";
                    }
                    ?>
                </select>
            </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Active"
                                                        id="status_activated" name="status" checked>
                                                    <label class="form-check-label"
                                                        for="status_activated">Active</label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" value="Not active"
                                                        id="status_not_activated" name="status">
                                                    <label class="form-check-label" for="status_not_activated">Not Active</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="row">
                                        <div class="col mb-3">
                                            <div class="form-group">
                                                <label>Image</label>
                                                <input class="form-control" type="file" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col d-flex justify-content-end">
                                    <button class="btn btn-primary" type="submit" >Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript"></script>

    <script>
    // jQuery to populate the modal with user data
         
        $('.edit-btn').on('click', function () {
            var id = $(this).data('id');
            var nom = $(this).data('nom');
            var prenom = $(this).data('prenom');
            var email = $(this).data('email');
            var phone = $(this).data('phone');
            var status = $(this).data('status');
            
            $('#user_id').val(id);
            $('#nom').val(nom);
            $('#prenom').val(prenom);
            $('#email').val(email);
            $('#phone').val(phone);
            $('input[name="status"][value="' + status + '"]').prop('checked', true);
        });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelector('#createUserForm').addEventListener('submit', function(event) {
            // Prevent form submission
            event.preventDefault();

            // Get all form inputs
            const inputs = document.querySelectorAll('#createUserForm input');

            // Define regular expression for email format validation
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Check each input for empty values and perform email format validation
            let hasEmpty = false;
            let isValidEmail = true;
            inputs.forEach(input => {
                if (input.value.trim() === '') {
                    input.classList.add('is-invalid');
                    hasEmpty = true;
                } else {
                    input.classList.remove('is-invalid');
                }
                
                // Perform email format validation for the email input
                if (input.name === 'email' && !input.value.match(emailRegex)) {
                    input.classList.add('is-invalid');
                    isValidEmail = false;
                }
            });

            // Custom validation for email domain
            if (isValidEmail && !isEmailValidDomain(inputs)) {
                isValidEmail = false;
                document.querySelector('input[name="email"]').classList.add('is-invalid');
            }

            // If any input is empty or email format is invalid, prevent form submission
            if (hasEmpty || !isValidEmail) {
                return false;
            }

            // If all inputs are filled and email format is valid, submit the form
            this.submit();
        });
    });

    // Function to check if email domain is valid
    function isEmailValidDomain(inputs) {
        const email = getInputValue(inputs, 'email');
        const validDomains = ['iteam-univ.tn']; // Add more valid domains here if needed
        const domain = email.split('@')[1];
        return validDomains.includes(domain);
    }

    // Function to get input value by name
    function getInputValue(inputs, name) {
        for (let input of inputs) {
            if (input.name === name) {
                return input.value;
            }
        }
        return null;
    }
</script>

    <script>
        
        document.addEventListener('DOMContentLoaded', function () {
            var deleteUserId;

            // Handle delete button click
            $('.delete-btn').click(function () {
                deleteUserId = $(this).data('id');
                console.log('Delete button clicked. User ID:', deleteUserId);
            });

            // Handle confirm deletion button click
            $('#confirmDeleteBtn').click(function () {
                console.log('Confirm deletion button clicked.');
                // Send AJAX request to delete user
                $.ajax({
                    url: '../delete.php',
                    method: 'GET', // Change method to GET
                    data: { id: deleteUserId },
                    success: function (response) {
                        console.log('AJAX request successful. Response:', response);
                        // Check if deletion was successful
                        if (response === 'success') {
                            console.log('Deletion successful.');
                            // Optional: display success message
                            window.location.reload(); // Reload the page to reflect changes
                        } else {
                            console.error('Error deleting user.');
                            // Optional: display error message
                        }
                    },
                    error: function () {
                        console.error('AJAX request failed.');
                        // Optional: display error message
                    }
                });
            });
        });
    </script>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
            var datenaiss = " ";
            if (datenaiss) {
                document.getElementById('datenaiss').value = datenaiss;
            }
        });

    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
        <script>
$(document).ready(function() {
    $('#createUserForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the form from submitting the normal way
        var formData = new FormData(this);

        $.ajax({
            url: 'create_user.php',
            type: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                console.log(response);
                alert('User created successfully');
                $('#user-form-modal').modal('hide'); // Hide the modal
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
                alert('Error creating user');
            }
        });
    });
});
</script>
</body>

</html>