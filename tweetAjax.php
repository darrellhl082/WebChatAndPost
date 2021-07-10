<?php 
require 'functions.php'; 
$tweet = query("SELECT * FROM tweet ORDER BY IDTweet DESC");

?>
<br>
<br>
<br>
<div class="refreshTweet btn ms-auto me-auto mb-3 w-25 btn-primary">
    Refresh</div>
<?php foreach ($tweet as $tweetRow ) : ?>

<div class="card twitCard">
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

    </div>



</div>
<?php endforeach; ?>

<script>
// alert("ada post baru");
</script>