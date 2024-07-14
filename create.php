<?php
include "connection.php";


?>

<?php


if (isset($_POST["submit"])) {
  $nom = $_POST['nom'];
  $prénom = $_POST['prénom'];
  $email = $_POST['email'];
  
  $password = $_POST['password'];
  $hashed_password = password_hash($password, PASSWORD_DEFAULT);
 

  $sql = "INSERT INTO `user`(`nom`,`prénom`, `email`,`password`) VALUES ('$nom','$prénom', '$email','$$hashed_password')";
  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: crud.php?msg=New record created successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  
</head>

<body>
  <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;font-weight: bold;">
   create new users
  </nav>

  <div class="container">
    <div class="text-center mb-4">
      <h3>Add New User</h3>
      <p class="text-muted">Complete the form below to add a new user</p>
    </div>

    <div class="container d-flex justify-content-center">
      <form action="" method="POST" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
          <div class="col">
            <label class="form-label">First Name:</label>
            <input type="text" class="form-control" id="nom" name="nom" placeholder="First Name">
          </div>

          <div class="col">
            <label class="form-label">Last Name:</label>
            <input type="text" class="form-control" id="nom" name="prénom" placeholder="Last Name">
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Email:</label>
          <input type="email" class="form-control" id="nom" name="email" placeholder="name@example.com">
        </div>

       

        <div class="col">
          <label class="form-label"> PASSWORD: </label>
          <input type="password" class="form-control" id="password" name="password" placeholder="********"> <br>
        </div>



        <div>
          <button type="submit" class="btn btn-success" name="submit">Save</button>
          <a href="crud.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>