<?php
session_start();

if (!isset($_SESSION["login"]) AND !isset($_SESSION["id"])) {
	header ("Location: login.php");
	exit;
} 
require 'functions.php'; 
$users = query("SELECT * FROM users");
$id = $_SESSION['id'];
$user = query("SELECT * FROM users WHERE IDUser =$id ");
$chat = query("SELECT * FROM chat");

$partner = $_GET["id"];
if (!$result){
	echo mysqli_error($conn);
}

if (isset($_POST["send"])) {
  if(!send($_POST) > 0){
		echo "
			<script>
				
				alert('Failed');
			</script>
		";
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
    <link rel="stylesheet" href="css/chatStyle.css">
    <title>D'realProject| Chat</title>
</head>

<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-light bg-light"
        style="border-bottom: 1px solid rgb(219,219,219);">
        <div class="container ">
            <a class="navbar-brand" href="myAccount.php">
                <img class="rounded-circle" style="width: 2.5rem;" src="img/avatar/<?php echo $user[0]["avatarUser"];?>"
                    alt="<?php echo $user[0]["username"];?>">
                <span>
                    <?php echo $user[0]["username"];?>
                </span>
            </a>
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
    <input type="hidden" class="username" value="<?php echo $user[0]["username"];?>">
    <div class="container content">

        <div class="row main">
            <div class="col-md-4 chatList ">

                <div class="list-group chatList desktop">
                    <?php foreach ($users as $identify) :?>

                    <a href="chat.php?id=<?php echo $identify["username"]; ?>"
                        class="list-group-item list-group-item-action <?php echo $identify["username"]; ?>">
                        <div class="avatarField">
                            <img src="img/avatar/<?php echo $identify["avatarUser"] ?>"
                                class="avatar rounded-circle img-thumbnail" alt="">
                            <h5 style="display: inline;"><?php echo $identify["username"] ?></h5>
                        </div>
                    </a>

                    <?php endforeach ?>

                </div>
                <div class="list-group chatList mobile" style="margin-top: 10rem;">
                    <?php foreach ($users as $identify) :?>

                    <a href="chatMob.php?id=<?php echo $identify["username"]; ?>"
                        class="list-group-item list-group-item-action <?php echo $identify["username"]; ?>">
                        <div class="avatarField">
                            <img src="img/avatar/<?php echo $identify["avatarUser"] ?>"
                                class="avatar rounded-circle img-thumbnail" alt="">
                            <h5 style="display: inline;"><?php echo $identify["username"] ?></h5>
                        </div>
                    </a>
                    <?php endforeach ?>

                </div>
            </div>
            <div class="col-md-8 chatBox position-relative p-0">
                <div class="container-fluid h-100  position-relative open top-50 w-100 text-center">
                    <h3>Your Messages</h3>
                    <h5 class="d-block">Send messages to your friend</h5>
                    <!-- <button type="button" class="btn start  btn-primary">Start</button> -->
                </div>
                <div class="container-fluid chatCol d-none h-100 ">

                    <div class="position-sticky account bg-white p-2 top-0 start-0 end-0 text-white">
                        <?php 
                    $partnerAvatar = query("SELECT avatarUser FROM users WHERE username = '$partner'");
                    
                    ?>
                        <a href="" class="">
                            <div class=" ">
                                <img class=" avatar rounded-circle "
                                    src=" img/avatar/<?php echo $partnerAvatar[0]['avatarUser']; ?>" alt="">
                                <h5 style="display: inline;"><?php echo $partner; ?></h5>


                            </div>
                        </a>

                    </div>

                    <div class="row bubbleField pb-5">
                        <div class="col-md bubCol">
                            <?php 
                            $pov = $user[0]["username"];
                            $withWho = $partner;
                            $MeOther = $pov;
                            $MeOther .='With';
                            $MeOther .= $withWho;
                            $OtherMe = $withWho;
                            $OtherMe .= 'With';
                            $OtherMe .= $pov;
                            
                            $chatContent = query("SELECT * FROM chat WHERE MeOther IN ('$MeOther','$OtherMe') ");
                            
                            ?>

                            <div class="bubble container-fluid mb-2">

                                <?php $i=0; foreach ($chatContent as $key):?>
                                <?php $check = identify($key["Identify"], $pov)?>
                                <div class=" w-50 bub bub<?php echo $i;?> mb-3  ">
                                    <input type="hidden" value="" name="identify2"
                                        class="identify<?php echo $i;?> <?php echo $check;?>">

                                    <p>
                                        <?php echo $key["ChatContent"]; ?>

                                    </p>
                                </div>

                                <?php 
                                $i++;
                                endforeach ?>


                            </div>

                        </div>

                    </div>
                    <div class="type  position-sticky bg-white container-fluid bottom-0 start-0 end-0 ">
                        <form action="" method="post">
                            <?php 
                        $Me = $user[0]["username"];
                        $Me .= 'ToOther';
                            ?>
                            <input type="hidden" value="<?php echo $MeOther;?>" name="MeOther" id="MeOther">
                            <input type="hidden" value="<?php echo $OtherMe;?>" name="OtherMe" id="OtherME">
                            <input type="hidden" value="<?php echo $Me;?>" name="identify" id="identify">
                            <input type="text" id="chatText" required name="chatText"
                                class="form-control border-primary" style="display: inline;width: 90%;"
                                placeholder="Type Something...">
                            <button type="submit" id="send" name="send" class="btn btn-outline-primary"
                                style="display: inline;">Send</button>

                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $('.<?php echo $user[0]["username"];?>').hide();

        var check2 = '<?php $pov.='ToOther'; echo $pov; ?>';
        var check;
        var bub;
        for (let i = 0; i < <?php echo count($chatContent); ?>; i++) {
            check = ".identify" + i;
            bub = ".bub" + i;

            if (!$(check).hasClass('Me')) {

                $(bub).removeClass('bg-primary');
                $(bub).addClass('bg-secondary');
                $(bub).addClass('me-auto');
                $(bub).removeClass('ms-auto');
            } else if ($(check).hasClass('Me')) {

                $(bub).removeClass('bg-secondary');
                $(bub).addClass('bg-primary');
                $(bub).addClass('ms-auto');
                $(bub).removeClass('me-auto');

            }

        }

        setInterval(() => {
            $.get('chatAjax.php?id=<?php echo $partner; ?>', function(data) {
                $('.bubCol').html(data);

            })
        }, 5000);


    });
    </script>
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
<?php 
if (isset($_GET["id"])) {
    echo"<script>
    
    
    $('.chatCol').removeClass('d-none');
        $('.open').addClass('d-none');</script>";
}?>

</html>