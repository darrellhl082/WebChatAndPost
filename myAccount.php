<?php
session_start();

if (!isset($_SESSION["login"]) AND !isset($_SESSION["id"])) {
	header ("Location: login.php");
	exit;
} 
require 'functions.php'; 
$id = $_SESSION['id'];
$user = query("SELECT * FROM users WHERE IDUser = $id ");
$name = $user[0]["username"];
$post = query("SELECT * FROM post WHERE WhoPosted = '$name' ORDER BY IDPost DESC");
$tweet = query("SELECT * FROM tweet WHERE WhoTweeted = '$name' ORDER BY IDTweet DESC  ");

if (!$result){
	echo mysqli_error($conn);
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
    <link rel="stylesheet" href="css/myAccountStyle.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <style>
    * {
        color: black;
    }

    body {
        background-color: rgb(235, 235, 235);
    }

    .content {

        overflow: hidden;
    }

    a {
        color: black;
        text-decoration: none;

    }



    .card-title {
        color: black;
    }

    .card-body a img {
        width: 4rem;
    }

    .card {
        border: 1px solid rgb(219, 219, 219);
        background: white;
    }

    nav {
        border-bottom: 1px solid rgb(219, 219, 219);
    }

    .jumbotron {
        border: 1px solid rgb(219, 219, 219);
    }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>D'realProject | My Account</title>
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
    <div class="content">
        <div class="bg"></div>
        <div class="container h-auto jumbotron w-50 ms-auto me-auto mt-2 pt-5 mb-5 bg-white text-center">
            <a href="" class="text-decoration-none ">
                <?php foreach ($user as $identify) :?>

                <img src="img/avatar/<?php echo $identify["avatarUser"]; ?>"
                    class="img-thumbnail w-25 mb-2 jumbAvatar rounded-circle"
                    alt=" <?php echo $identify["username"]; ?>">
                <p class="fs-2" text-decoration-none"> <?php echo $identify["username"]; ?></p>
                <?php endforeach ?>
            </a>
            <a href="edit.php" class="btn btn-primary mb-4">Edit</a>
        </div>
        <div class="container switch text-center mb-4 ">
            <button type="button" class="btn btn-primary postField">Post</button>
            <button type="button" class="btn btn-outline-primary twitField">Tweet</button>
        </div>
        <div class="container text-white">
            <div class="row">
                <div class="col-md-6 main">
                    <?php foreach ($post as $row) :?>

                    <div class=" container">
                        <div class="card mb-3 postCard ">

                            <div class="card-body">
                                <a href=""><img class="rounded-circle img-thumbnail"
                                        src="img/avatar/<?php echo $row["Avatar"];?>"
                                        alt="<?php echo $row["WhoPosted"];?>"></a>
                                <h4 class="card-title d-inline ms-2"><a href="">
                                        <?php echo $row["WhoPosted"];?></a></h4>

                            </div>
                            <img src="img/post/<?= $row["Photo"];?>" class="card-img-top"
                                alt="<?php echo $row["WhoPosted"];?>'s Post">
                            <div class="card-body">

                                <h5 class="card-title"><a href=""> <?php echo $row["WhoPosted"];?></a></h5>
                                <p class="card-text"> <?php echo $row["Caption"];?></p>
                                <a href="deletePost.php?id=<?php echo $row["IDPost"];?>" name="postDelete"
                                    class="btn btn-danger w-25">Delete</a>

                            </div>
                        </div>


                    </div>

                    <?php endforeach;?>



                </div>
                <div class="col-md-6 right">
                    <?php foreach ($tweet as $tweetRow ) : ?>

                    <div class="card mb-3 twitCard">
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="#" class="">
                                    <img class="avatar rounded-circle img-thumbnail"
                                        src="img/avatar/<?php echo $tweetRow["AvatarTweet"]; ?>"
                                        alt="<?php echo $tweetRow["WhoTweeted"]; ?>">
                                    <span><?php echo $tweetRow["WhoTweeted"]; ?></span>
                                </a>
                            </h5>

                            <p class="card-text"> <?php echo $tweetRow["Tweet"]; ?></p>
                            <a href="deleteTweet.php?id=<?php echo $tweetRow["IDTweet"];?>" name="tweetDelete"
                                class="btn btn-danger w-25">Delete</a>
                        </div>



                    </div>
                    <?php endforeach; ?>

                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script src="js/scriptMyAccount.js"></script>
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