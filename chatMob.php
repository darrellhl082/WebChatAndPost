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
    <link rel="stylesheet" href="css/chatMobStyle.css">
    <title>D'realProject | Chat</title>
</head>

<body>
    <nav class="sticky-top navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a href="accountView.php?id=<?php echo $partner; ?>" class="navbar-brand">

                <?php 
                    $partnerAvatar = query("SELECT avatarUser FROM users WHERE username = '$partner'");
                    
                    ?>

                <img class=" avatar rounded-circle " src=" img/avatar/<?php echo $partnerAvatar[0]['avatarUser']; ?>"
                    alt="">
                <h5 style="display: inline;"><?php echo $partner; ?></h5>

            </a>
            <a href="chat.php" name="back" class="btn btn-outline-secondary" id="back">Back</a>

        </div>
    </nav>
    <div class="container-fluid content p-3 bubCol">
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

        <?php $i=0; foreach ($chatContent as $key):?>
        <?php $check = identify($key["Identify"], $pov)?>
        <div class="bubble w-50 text-white bub bub<?php echo $i;?> p-3  mb-3">
            <input type="hidden" value="" name="identify2" class="identify<?php echo $i;?> <?php echo $check;?>">
            <?php echo $key["ChatContent"]; ?>
        </div>
        <?php 
         $i++;
      endforeach ?>

    </div>

    <div class="type  fixed-bottom bg-white container-fluid text-center ">
        <form action="" method="post">
            <?php 
                        $Me = $user[0]["username"];
                        $Me .= 'ToOther';
                            ?>
            <input type="hidden" value="<?php echo $MeOther;?>" name="MeOther" id="MeOther">
            <input type="hidden" value="<?php echo $OtherMe;?>" name="OtherMe" id="OtherME">
            <input type="hidden" value="<?php echo $Me;?>" name="identify" id="identify">
            <input type="text" autofocus id="chatText" name="chatText" class="form-control border-primary"
                style="display: inline;width: 75%;" required placeholder="Type Something...">
            <button type="submit" id="send" name="send" class="btn btn-outline-primary"
                style="display: inline;">Send</button>

        </form>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {



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
            $.get('chatAjaxMob.php?id=<?php echo $partner; ?>', function(data) {
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

</html>