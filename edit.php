<?php 
session_start();

if (!isset($_SESSION["login"]) AND !isset($_SESSION["id"])) {
	header ("Location: login.php");
	exit;
} 
require 'functions.php'; 

$id = $_SESSION['id'];
 $user = query("SELECT * FROM users WHERE IDUser =$id ");

if(isset($_POST["submit"])){
  
	if(update($_POST) >= 0){
		echo "
			<script>
			
				document.location.href = 'myAccount.php';
			</script>
		";
	} else {
		echo "	
			<script>
				alert('Failed');
				
			</script>";
		echo mysqli_error($conn);
	}
}

?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="css/editStyle.css">
    <title>D'realProject | Edit
    </title>
</head>

<body>
    <nav class="navbar sticky-top bg-white navbar-expand-lg navbar-light ">
        <div class="container">
            <a class="navbar-brand" href="#">D'realProject</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Back to Home</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <div class="container main bg-white  justify-content-center  mt-4 p-5">
        <img src="img/avatar/<?php echo $user[0]["avatarUser"]; ?>" alt="  <?php echo $user[0]["avatarUser"]; ?>"
            class="rounded-circle" style="width: 3rem;">
        <h4 class="ms-3" style="display: inline;"> <?php echo $user[0]["username"]; ?></h4>

        <form action="" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="hidden" name="fotoLama" value="<?php echo $user[0]["avatarUser"]; ?>">

            <a href="#" class="btn changeBtn mb-3  me-auto mt-3 btn-outline-secondary fs-6 d-block">Change
                My Photo
                Profile</a>
            <div class="change d-none mb-3   me-auto">
                <label for="formFile" class="form-label">Upload Photo</label>
                <input class="form-control" type="file" name="Photo" id="Photo">

            </div>
            <div class="mb-3   me-auto">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="username" id="username"
                    value="<?php echo $user[0]["username"]; ?>" required>

            </div>

            <button type="submit" class="btn  me-auto mt-3 btn-outline-secondary fs-6 d-block" id="submit"
                name="submit">Update</button>
        </form>

    </div>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/editScript.js"></script>
    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>