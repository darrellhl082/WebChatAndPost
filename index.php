<?php
session_start();

if (!isset($_SESSION["login"]) AND !isset($_SESSION["id"])) {
	header ("Location: login.php");
	exit;
} 
require 'functions.php'; 
$post = query("SELECT * FROM post ORDER BY IDPost DESC");
$tweet = query("SELECT * FROM tweet ORDER BY IDTweet DESC");
$users = query("SELECT * FROM users");
$id = $_SESSION['id'];
$user = query("SELECT * FROM users WHERE IDUser =$id ");
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
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <title>darrellhl082Project</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light ">
        <div class="container align-items-end">
            <a class="navbar-brand" href="#">D'realProject</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto ">

                    <li class="nav-item responsiveNav">
                        <a class="nav-link active" aria-current="page" target="_blank"
                            href="https://www.instagram.com/darrellhl082/">My
                            Instagram</a>
                    </li>
                    <li class="nav-item responsiveNav2 ">
                        <div class=" list-group setting">

                            <a href="myAccount.php" class="list-group-item list-group-item-action ">My Account</a>
                            <a href="#" class="list-group-item list-group-item-action active"
                                aria-current="true">Home</a>
                            <a href="post.php" class="list-group-item list-group-item-action">Let's Post
                                Something</a>
                            <a href="twit.php" class="list-group-item list-group-item-action">Let's Tweet</a>
                            <a href="chat.php" class="list-group-item list-group-item-action">Let's Send a Message</a>
                            <a href="other.php" class="list-group-item list-group-item-action">Other People</a>
                            <a href="logout.php" class="list-group-item list-group-item-action">Log Out</a>
                    </li>
                    <li class="nav-item ">
                        <div class="dropdown">
                            <button class="btn drop dropdown-toggle" type="button" id="dropdownMenuButton1"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Darrell Hammam
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" target="_blank"
                                        href="https://www.instagram.com/darrellhl082/">My
                                        Instagram</a></li>

                            </ul>
                        </div>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <div class="otherField d-none position-fixed">
        <div class="container justify-content-center w-50 position-relative otherBox">
            <div class="row otherList list-group ">
                <button class="btn  closeOther btn-primary me-auto ms-auto mt-3 w-25">Close</button>
                <div class="col-md-12 mt-3">
                    <?php foreach ($users as $identify) :?>

                    <a href="accountView.php?id=<?php echo $identify["username"]; ?>"
                        class="list-group-item list-group-item-action <?php echo $identify["username"]; ?>">
                        <div class="avatarField">
                            <img src="img/avatar/<?php echo $identify["avatarUser"] ?>" class="avatar rounded-circle"
                                style="width: 5rem;" alt="">
                            <h4 class="ms-2" style="display: inline;"><?php echo $identify["username"] ?></h4>
                        </div>
                    </a>

                    <?php endforeach ?>
                    <?php foreach ($users as $identify) :?>


                    <?php endforeach ?>
                </div>

            </div>
        </div>
    </div>
    <div class="container switch text-center position-sticky">
        <button type="button" class="btn btn-primary postField">Post</button>
        <button type="button" class="btn btn-outline-primary twitField">Tweet</button>
    </div>
    <div class="container-fluid  ">
        <div class="row ">
            <div class="col-md-3 left ">
                <div class="leftNav position-sticky top-0 start-0 bottom-0 p-3"">
                    <div class=" list-group setting">
                    <a href="#" class="list-group-item list-group-item-action">
                        <div class="account text-center">

                            <?php foreach ($user as $identify ) :?>
                            <img class="avatar rounded-circle me-2" style="width: 5rem;"
                                src="img/avatar/<?php echo $identify["avatarUser"];?>" alt="">

                            <p class="d-inline fs-4"><?php echo $identify["username"]; ?></p>
                            <?php endforeach?>

                        </div>
                    </a>
                    <a href="myAccount.php" class="list-group-item list-group-item-action ">My Account</a>
                    <a href="#" class="list-group-item list-group-item-action active" aria-current="true">Home</a>
                    <a href="post.php" class="list-group-item list-group-item-action">Let's Post Something</a>
                    <a href="twit.php" class="list-group-item list-group-item-action">Let's Tweet</a>
                    <a href="chat.php" class="list-group-item list-group-item-action">Let's Send a
                        Message</a>
                    <a href="logout.php" class="list-group-item list-group-item-action">Log Out</a>

                </div>
                <div class="search mt-3 ">

                    <div style="border: 1px solid rgb(219, 219, 219); border-bottom:none;"
                        class="bg-white mb-0 container p-2 ps-3 other"><span>Other
                            People</span> </div>
                    <div class=" list-group">

                        <a href="accountView.php?id=darrellhl082" class="list-group-item list-group-item-action">
                            <img src="img/avatar/60cb25bc05223.jpeg" class="avatarSearch rounded-circle img-thumbnail"
                                alt="">
                            <span>darrellhl082</span>
                        </a>


                        <a type="" href="#" class="otherOpen list-group-item list-group-item-action">
                            <span>More People...</span>
                        </a>

                    </div>
                </div>
            </div>
        </div>
        <div class=" main col-md-5">

            <br>

            <div class="container center ">

                <div class="row justify-content-center">
                    <div style="z-index: 2;" class="refreshPost btn ms-md-auto me-md-auto mb-3 w-25 btn-primary">
                        Refresh</div>
                    <div class="col-md-12 postAjax">
                        <?php foreach ($post as $row) :?>

                        <div class=" container">
                            <div class="card mb-3 postCard ">

                                <div class="card-body">

                                    <a href="accountView.php?id=<?php echo $row["WhoPosted"]; ?>"><img
                                            class="rounded-circle img-thumbnail"
                                            src="img/avatar/<?php echo $row["Avatar"];?>"
                                            alt="<?php echo $row["WhoPosted"];?>"></a>
                                    <h4 class="card-title d-inline ms-2"><a
                                            href="accountView.php?id=<?php echo $row["WhoPosted"]; ?>">
                                            <?php echo $row["WhoPosted"];?></a></h4>

                                </div>
                                <img src="img/post/<?= $row["Photo"];?>" class="card-img-top"
                                    alt="<?php echo $row["WhoPosted"];?>'s Post">
                                <div class="card-body">

                                    <h5 class="card-title"><a
                                            href="accountView.php?id=<?php echo $row["WhoPosted"]; ?>">
                                            <?php echo $row["WhoPosted"];?></a></h5>
                                    <p class="card-text"> <?php echo $row["Caption"];?></p>

                                </div>
                            </div>


                        </div>

                        <?php endforeach;?>




                    </div>


                </div>
            </div>
        </div>

        <div class="col-md-4">

            <div class="leftNav right position-sticky top-0 end-0 bottom-0 tweetAjax">
                <br>
                <br>
                <br>
                <div class="refreshTweet btn    mb-3 w-25 btn-primary">
                    Refresh</div>
                <?php foreach ($tweet as $tweetRow ) : ?>

                <div class="card twitCard">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="accountView.php?id=<?php echo $tweetRow["WhoTweeted"]; ?>" class="">
                                <img class="avatar rounded-circle img-thumbnail"
                                    src="img/avatar/<?php echo $tweetRow["AvatarTweet"]; ?>"
                                    alt="<?php echo $tweetRow["WhoTweeted"]; ?>">
                                <span><?php echo $tweetRow["WhoTweeted"]; ?></span>
                            </a>
                        </h5>

                        <p class="card-text"> <?php echo $tweetRow["Tweet"]; ?></p>

                    </div>



                </div>
                <?php endforeach; ?>
            </div>
        </div>

















        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="js/jquery-3.6.0.min.js"></script>
        <script src="js/script.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
        </script>
        <script>
        $(document).ready(function() {

            $('.<?php echo $user[0]["username"];?>').hide();
            $('.otherOpen').click(function(e) {
                e.preventDefault();
                $('.otherField').removeClass("d-none");

            });
            $('.closeOther').click(function(e) {
                e.preventDefault();
                $('.otherField').addClass('d-none');

            });
        });
        </script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->
</body>

</html>