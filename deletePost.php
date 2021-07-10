<?php 
session_start();
if (!isset($_SESSION["login"])) {
	header ("Location: login.php");
	exit;
}
require 'functions.php';
 $id = $_GET["id"];

 if(deletePost($id) > 0 ){

 	echo "
		<script>
			alert('Post Deleted');
			document.location.href = 'myAccount.php';
		</script>
	";
 } else {
 	echo "
		<script>
			alert('Post Deleted');
		
			document.location.href = 'myAccount.php';
		</script>
		";
 }

 ?>