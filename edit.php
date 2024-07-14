<?php
include "connection.php";

if (!isset($_GET["id"])) {
    header("Location: crud.php");
    exit();
}

$id = $_GET["id"];
if (isset($_POST["submit"])) {
    $nom = $_POST['nom'];
    $prénom = $_POST['prénom'];
    $email = $_POST['email'];
    $status = $_POST['status'];
    $role = $_POST['role'];

    $sql = "UPDATE `user` SET `nom`='$nom',`prénom`='$prénom',`email`='$email',`status`='$status',`role`='$role' WHERE id = $id";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: crud.php?msg=Data updated successfully");
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
        updated users information
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit User Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php
        $sql = "SELECT * FROM `user` WHERE id = $id LIMIT 1";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>

        <div class="container d-flex justify-content-center">
            <form action="" method="post" style="width:50vw; min-width:300px;">
                <div class="row mb-3">
                    <div class="col">
                        <label class="form-label">First Name:</label>
                        <input type="text" class="form-control" name="nom" value="<?php echo $row['nom'] ?>">
                    </div>

                    <div class="col">
                        <label class="form-label">Last Name:</label>
                        <input type="text" class="form-control" name="prénom" value="<?php echo $row['prénom'] ?>">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email:</label>
                    <input type="email" class="form-control" name="email" value="<?php echo $row['email'] ?>">
                </div>

                
                <div class="form-group mb-3">
                    <label>Role:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="role" id="admin" value="admin" <?php echo ($row["role"] == 'admin') ? "checked" : ""; ?>>
                    <label for="admin" class="form-input-label">Admin</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="role" id="user" value="user" <?php echo ($row["role"] == 'user') ? "checked" : ""; ?>>
                    <label for="user" class="form-input-label">User</label>
                </div>

                <div class="form-group mb-3">
                    <label>status:</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="status" id="pending" value="pending" <?php echo ($row["status"] == 'pending') ? "checked" : ""; ?>>
                    <label for="pending" class="form-input-label">Pending</label>
                    &nbsp;
                    <input type="radio" class="form-check-input" name="status" id="enable" value="enable" <?php echo ($row["status"] == 'enable') ? "checked" : ""; ?>>
                    <label for="enable" class="form-input-label">Enable</label>
                </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="crud.php" class="btn btn-danger">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>