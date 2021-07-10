<?php 
require 'functions.php'; 
$post = query("SELECT * FROM post ORDER BY IDPost DESC");

?>
<?php foreach ($post as $row) :?>

<div class=" container">
    <div class="card mb-3 postCard ">

        <div class="card-body">
            <a href=""><img class="rounded-circle img-thumbnail" src="img/avatar/<?php echo $row["Avatar"];?>"
                    alt="<?php echo $row["WhoPosted"];?>"></a>
            <h4 class="card-title d-inline ms-2"><a href="">
                    <?php echo $row["WhoPosted"];?></a></h4>

        </div>
        <img src="img/post/<?= $row["Photo"];?>" class="card-img-top" alt="<?php echo $row["WhoPosted"];?>'s Post">
        <div class="card-body">

            <h5 class="card-title"><a href=""> <?php echo $row["WhoPosted"];?></a></h5>
            <p class="card-text"> <?php echo $row["Caption"];?></p>

        </div>

    </div>


</div>

<?php endforeach;?>

<script>
// alert("ada post baru");
</script>