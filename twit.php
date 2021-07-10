<?php 
session_start();

if (!isset($_SESSION["login"])) {
	header ("Location: login.php");
	exit;
} 
require 'functions.php';
$id = $_SESSION['id'];
$user = query("SELECT * FROM users WHERE IDUser = $id ");
if (!$result){
	echo mysqli_error($conn);
}

if(isset($_POST["submit"])){
	
	if(addTweet($_POST) > 0){
		echo "
			<script>
				
				 document.location.href = 'index.php';
			</script>
		";
       
	} else {
		echo"	
        <script>
		    alert('Failed');
		</script>";
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
    <link rel="stylesheet" href="css/postStyle.css">
    <title>D'realProject | Tweet</title>
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
    <div class="container main bg-white  p-4 mt-5">
        <form action="" method="post">
            <?php foreach ($user as $row) : ?>

            <input type="hidden" name="Avatar" value="<?php echo $row["avatarUser"];?>">


            <input type="hidden" name="WhoPosted" value="<?php echo $row['username'];?>">


            <div class="account">
                <img src="img/avatar/<?php echo $row["avatarUser"];?>" alt="darrellhl082" class="rounded-circle"
                    style="width: 4rem;">
                <h4 class="ms-2 d-inline"><?php echo $row['username'];?></h4>
            </div>
            <?php endforeach ?>
            <div class="mb-3">
                <label for="caption" class="form-label"></label>
                <textarea class="form-control" id="Caption" name="Caption" rows="3" placeholder="What's happening?"
                    required></textarea>
            </div>
            <button type="submit" id="submit" name="submit" class="btn btn-primary">Let's Tweet</button>
        </form>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>