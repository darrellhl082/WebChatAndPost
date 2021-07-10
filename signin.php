<?php 
require 'functions.php';
if(isset($_POST["submit"])){
	
	if(signin($_POST) > 0){
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
    <link rel="stylesheet" href="css/styleSignin.css">
    <title>D'realProject | Sign in</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
</head>

<body>
    <div class="container-md signinField mt-5 ">
        <h1 class="text-center" style="color: black; margin-bottom:2rem;">Sign In</h1>
        <form name="signin" action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="formFile" class="form-label">Profile Photo</label>
                <input class="form-control" name="Photo" type="file" id="Photo">
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="Muhammad Iqbal"
                    required>
                <label for="username">Username</label>
            </div>
            <div class="form-floating mb-3">
                <input name="password" placeholder="Muhammad Iqba" type="password" class="form-control" id="password"
                    required>
                <label for="password">Password</label>
            </div>
            <div class="form-floating">
                <input name="repassword" placeholder="Muhammad Iqba" type="password" class="form-control"
                    id="repassword" required>
                <label for="repassword">Re-type Password</label>
            </div>


            <button type="submit" class="btn btn-primary mt-3 " name="submit" id="signinBtn">Sign In</button>

        </form>
    </div>



















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