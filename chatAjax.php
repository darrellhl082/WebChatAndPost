<?php 
session_start();


require 'functions.php'; 
$users = query("SELECT * FROM users");
$id = $_SESSION['id'];
$user = query("SELECT * FROM users WHERE IDUser =$id ");
$chat = query("SELECT * FROM chat");

$partner = $_GET["id"];
if (!$result){
	echo mysqli_error($conn);
}
?>

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
        <input type="hidden" name="identify2" class="identify<?php echo $i;?> <?php echo $check;?>">

        <p>
            <?php echo $key["ChatContent"]; ?>

        </p>
    </div>

    <?php 
        $i++;
        endforeach ?>
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
});
</script>