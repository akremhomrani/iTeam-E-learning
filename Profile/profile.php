<?php
include ('../connection.php');
session_start();

if (!isset($_SESSION['email'])) {
  header("Location: ../login-2.php");
  exit();
}

$email = $_SESSION['email'];

// Retrieve user information based on email
$sql = "SELECT * FROM user WHERE email='$email'";
$result_user = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result_user);

// Retrieve all users with role 'student' except the current logged in user
$sql_all_users = "SELECT * FROM user WHERE email != '$email' AND role = 'student'";
$result_all_users = mysqli_query($conn, $sql_all_users);

// Count total users with role 'student' except the current logged in user
$sql_user_count = "SELECT COUNT(*) as total FROM user WHERE email != '$email' AND role = 'student'";
$result_user_count = mysqli_query($conn, $sql_user_count);
$row_count = mysqli_fetch_assoc($result_user_count);
$total_users = $row_count['total'];

$modules = [];
if ($row['role'] == 'teacher') {
  $user_id = $row['id'];
  $sql_modules = "SELECT * FROM module WHERE created_by = $user_id";
  $result_modules = mysqli_query($conn, $sql_modules);
  if ($result_modules) {
      $modules = array(); // Initialize an empty array to store modules
      while ($module = mysqli_fetch_assoc($result_modules)) {
          $modules[] = $module;
      }
      // Now $modules array contains all the modules created by the current teacher
  } else {
      // Handle query error
      echo "Error: " . mysqli_error($conn);
  }
}

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

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Retrieve module ID and group ID from the form
  $module_id = $_POST['module_id'];
  $group_id = $_POST['group'];

  // Perform database query to insert the module into the group
  $sql_insert = "INSERT INTO group_module (group_id, module_id) VALUES ('$group_id', '$module_id')";
  if (mysqli_query($conn, $sql_insert)) {
    echo "Module added to group successfully!";
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>profile friends with search input - Bootdey.com</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../header/header.css">
</head>

<body>


<div class="fixe" >
  
  
  <div class="navbar navbar-fixed-top">
    <a href="../index.php">
      <img src="../images/icon/logo.PNG" class="loh" alt="Image 1">
    </a>
    <ul >
      <li  class="info"><a href="../subjects/computer_courses.php"><i class='fas fa-graduation-cap'></i> Courses</a></li>
      <li  class="info"><a class="get-started" href="<?php echo $loggedin ? '../logout.php' : '../login-2.php'; ?>"><i class="fa fa-user" aria-hidden="true"></i> <?php echo $loggedin ? 'Logout' : 'Login'; ?></a></li>
      
                    
                </a>
    </ul>
  </div>
</div>



  <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
  <div class="container">
    <!-- profil header -->
    <div class="card overflow-hidden">
      <div class="card-body p-0">
        <img src="https://media.licdn.com/dms/image/C561BAQFq0cRNlYBMxA/company-background_10000/0/1588781798389/iteam_univ_cover?e=2147483647&v=beta&t=OWwCCvsF2TClfkhD3_5rousu2s-2NJaBW4HDsFwk0pw" alt="" class="img-fluid">
        <div class="row align-items-center">
          <div class="col-lg-4 order-lg-1 order-2"></div>
          <div class="col-lg-4 mt-n3 order-lg-2 order-1">
            <div class="mt-n5">
              <div class="d-flex align-items-center justify-content-center mb-2">
                <div class="linear-gradient d-flex align-items-center justify-content-center rounded-circle" style="width: 110px; height: 110px;">
                  <div class="border border-4 border-white d-flex align-items-center justify-content-center rounded-circle overflow-hidden" style="width: 100px; height: 100px;">
                    <img src="../images/creator/<?php echo $row['image']; ?>" alt class="w-100 h-100">
                  </div>
                </div>
              </div>
              <div class="text-center">
                <h5 class="fs-5 mb-0 fw-semibold"><?php echo $row['nom']; ?> <?php echo $row['prenom']; ?></h5>
                <p class="mb-0 fs-4">                  <?php echo ($row['role'] == 'student') ? 'Student' : $row['role']; ?>
</p>
              </div>
            </div>
          </div>
          <div class="col-lg-4 order-last">
            <ul class="list-unstyled d-flex align-items-center justify-content-center justify-content-lg-start my-3 gap-3">
              <li><button class="btn btn-primary" type="button" onclick="window.location.href = 'editprofile.php';">Edit Profile</button></li>
            </ul>
          </div>
        </div>
      </div>
    </div>





<!-- for student  friends-->

    <?php
if ($row['role'] == 'student') {
  ?>

    <div class="tab-content" id="pills-tabContent">
      <div class="tab-pane fade show active" id="pills-friends" role="tabpanel" aria-labelledby="pills-friends-tab" tabindex="0">
        <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
          <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Friends <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"><?php echo $total_users; ?></span></h3>
          <form class="position-relative">
            <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh" placeholder="Search Friends">
            <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
          </form>
        </div>
        <div class="row" id="friends-list">
          <?php
          // Loop through fetched users
          while ($user = mysqli_fetch_assoc($result_all_users)) {
          ?>
            <div class="col-sm-6 col-lg-4 user-card" data-name="<?php echo strtolower($user['nom'] . ' ' . $user['prenom']); ?>">
              <div class="card hover-img">
                <div class="card-body p-4 text-center border-bottom">
                  <img src="../images/creator/<?php echo $user['image']; ?>" alt="" class="rounded-circle mb-3" width="80" height="80">
                  <h5 class="fw-semibold mb-0"><?php echo $user['nom'] . ' ' . $user['prenom']; ?></h5>
                  <span class="text-dark fs-2">
                  <?php echo ($user['role'] == 'student') ? 'Student' : $user['role']; ?>
                  </span>
                </div>
                <ul class="px-2 py-2 bg-light list-unstyled d-flex align-items-center justify-content-center mb-0">
                  <!-- Icon for sending a message -->
                  <li class="position-relative">
                      <i class="fas fa-envelope"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          <?php } ?>
          <div class="col-12" id="no-results" style="display: none;">
            <p class="text-center fs-4">User not available</p>
          </div>
        </div>
      </div>
    </div>
    <?php
}
?>
<!-- modules section -->
   <?php if ($row['role'] == 'teacher') { ?>
        <div class="d-sm-flex align-items-center justify-content-between mt-3 mb-4">
            <h3 class="mb-3 mb-sm-0 fw-semibold d-flex align-items-center">Courses <span class="badge text-bg-secondary fs-2 rounded-4 py-1 px-2 ms-2"><?php echo count($modules); ?></span></h3>
            <form class="position-relative">
                <input type="text" class="form-control search-chat py-2 ps-5" id="text-srh-modules" placeholder="Search Courses">
                <i class="ti ti-search position-absolute top-50 start-0 translate-middle-y text-dark ms-3"></i>
            </form>
        </div>
        <div class="row" id="modules-list">
            <?php foreach ($modules as $module) { ?>
                <div class="col-sm-6 col-lg-4 module-card" data-title="<?php echo strtolower($module['title']); ?>">
         

                    <div class="card border-hover-primary hover-scale">
                        <div class="card-body">
                            <div class="text-primary mb-5">
                                <svg width="60" height="60" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"></rect>
                                        <path
                                            d="M22,17 L22,21 C22,22.1045695 21.1045695,23 20,23 L4,23 C2.8954305,23 2,22.1045695 2,21 L2,17 L6.27924078,17 L6.82339262,18.6324555 C7.09562072,19.4491398 7.8598984,20 8.72075922,20 L15.381966,20 C16.1395101,20 16.8320364,19.5719952 17.1708204,18.8944272 L18.118034,17 L22,17 Z"
                                            fill="currentColor"></path>
                                        <path
                                            d="M2.5625,15 L5.92654389,9.01947752 C6.2807805,8.38972356 6.94714834,8 7.66969497,8 L16.330305,8 C17.0528517,8 17.7192195,8.38972356 18.0734561,9.01947752 L21.4375,15 L18.118034,15 C17.3604899,15 16.6679636,15.4280048 16.3291796,16.1055728 L15.381966,18 L8.72075922,18 L8.17660738,16.3675445 C7.90437928,15.5508602 7.1401016,15 6.27924078,15 L2.5625,15 Z"
                                            fill="currentColor" opacity="0.3"></path>
                                        <path
                                            d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z"
                                            fill="currentColor" fill-rule="nonzero"
                                            transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "></path>
                                    </g>
                                </svg>
                            </div>
                            <a href="addcours.php?module_id=<?php echo $module['idmod']; ?>" class="text-decoration-none"> 

                            <h6 class="font-weight-bold mb-3"><?php echo $module['title']; ?></h6></a>
                            <p class="text-muted mb-0"><?php echo $module['description']; ?></p>
                        </div>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addGroupModal">Add Group</button>

                    </div>
                </div>
            <?php } ?>
            <div class="col-12" id="no-results-modules" style="display: none;">
                <p class="text-center fs-4">Module not available</p>
            </div>
        </div>
    <?php } ?>
    
    
</div>


<!-- add group modal -->
<div class="modal fade" id="addGroupModal" tabindex="-1" aria-labelledby="addGroupModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addGroupModalLabel">Select Group</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
          <div class="mb-3">
            <label for="group" class="form-label">Select Group</label>
            <select class="form-select" id="group" name="group">
              <?php
              // Retrieve all groups
              $sql_groups = "SELECT * FROM `group`";
              $result_groups = mysqli_query($conn, $sql_groups);
              while ($group = mysqli_fetch_assoc($result_groups)) {
                echo "<option value='{$group['id_g']}'>{$group['formation']} - {$group['year']}</option>";
              }
              ?>
            </select>
          </div>
          <input type="hidden" name="module_id" value="<?php echo $module['idmod']; ?>">
          <button type="submit" class="btn btn-primary">Add to Group</button>
        </form>
      </div>
    </div>
  </div>
</div>



<!-- marque section -->
<marquee style=" margin-bottom: 20px;" direction="left"  
		scrollamount="60">
		<div class="marqu">
			<img src="../images/icon/logo.PNG" alt="">
			<img src="../images/icon/logo.PNG" alt="">
			<img src="../images/icon/logo.PNG" alt="">
			<img src="../images/icon/logo.PNG" alt="">
		</div>
	</marquee>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
  <script type="text/javascript">
    document.getElementById('text-srh').addEventListener('input', function() {
      var searchQuery = this.value.toLowerCase();
      var userCards = document.querySelectorAll('.user-card');
      var noResults = document.getElementById('no-results');
      var found = false;

      userCards.forEach(function(card) {
        var userName = card.getAttribute('data-name');
        if (userName.includes(searchQuery)) {
          card.style.display = '';
          found = true;
        } else {
          card.style.display = 'none';
        }
      });

      if (found) {
        noResults.style.display = 'none';
      } else {
        noResults.style.display = '';
      }
    });
  </script>
</body>

</html>
