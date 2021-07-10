<?php 
$conn = mysqli_connect("localhost","root","","project1");
function query($query){
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while($row = mysqli_fetch_assoc($result)){
        $rows[] = $row;
    }
    return $rows;
    
}
function addPost($data){
	$WhoPosted = htmlspecialchars($data["WhoPosted"]);
	$Caption = htmlspecialchars($data["Caption"]);
	$Avatar = htmlspecialchars($data["Avatar"]);
	$id = htmlspecialchars($data["id"]);
	$Photo = uploadPost();
	global $conn;
 	$query = "INSERT INTO post 
			VALUES 
			(not null,'$WhoPosted',$id,'$Avatar', '$Photo' ,'$Caption')";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function addTweet($data){
	$WhoPosted = htmlspecialchars($data["WhoPosted"]);
	$Caption = htmlspecialchars($data["Caption"]);
	$Avatar = htmlspecialchars($data["Avatar"]);
	
	
	global $conn;
 	$query = "INSERT INTO tweet 
			VALUES 
			(not null,'$WhoPosted','$Avatar', '$Caption')";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}
function uploadPost(){
	
	$namaFile = $_FILES['Photo']['name'];
	$ukuranFile = $_FILES['Photo']['size'];
	$error = $_FILES['Photo']['error'];
	$tmpName = $_FILES['Photo']['tmp_name'];
	$typeFile = $_FILES['Photo']['type'];

	if($error === 4){
		echo "
		<script>
			alert('Anda tidak menginput foto, foto akan default');
		</script>
		";
		return 'anonim.jpg';
	}

	$ekstensiValid = ['image/jpg','image/jpeg','image/png'];
	 
	if(!in_array($typeFile, $ekstensiValid)){
		echo "
		<script>
			alert('Foto akan default');
		</script>
		";
		return 'anonim.jpg';
	}

	if ($ukuranFile > 2000000){
		echo "
		<script>
			alert('File terlalu besar,diset ke default');

		</script>
		";
		return 'anonim.jpg';
	}

	$namaBaru = uniqid();
	$namaBaru .='.';
	$namaBaru .= end(explode('/', $typeFile));

	if(!move_uploaded_file($tmpName, 'img/post/'. $namaBaru)){

		return false;
	}
	return $namaBaru;


}
function uploadAvatar(){
	
	$namaFile = $_FILES['Photo']['name'];
	$ukuranFile = $_FILES['Photo']['size'];
	$error = $_FILES['Photo']['error'];
	$tmpName = $_FILES['Photo']['tmp_name'];
	$typeFile = $_FILES['Photo']['type'];

	if($error === 4){
		echo "
		<script>
			alert('Anda tidak menginput foto, foto akan default');
		</script>
		";
		return 'anonim.jpg';
	}

	$ekstensiValid = ['image/jpg','image/jpeg','image/png'];
	 
	if(!in_array($typeFile, $ekstensiValid)){
		echo "
		<script>
			alert('Foto akan default');
		</script>
		";
		return 'anonim.jpg';
	}

	if ($ukuranFile > 2000000){
		echo "
		<script>
			alert('File terlalu besar,diset ke default');
		</script>
		";
		
	}

	$namaBaru = uniqid();
	$namaBaru .='.';
	$namaBaru .= end(explode('/', $typeFile));

	if(!move_uploaded_file($tmpName, 'img/avatar/'. $namaBaru)){

		return false;
	}
	return $namaBaru;


}
function signin($data){
	global $conn;
	$username = strtolower(stripslashes($data["username"]));
	$password = mysqli_real_escape_string($conn, $data["password"]);
	$password2 = mysqli_real_escape_string($conn, $data["repassword"]);
    $avatarUser = uploadAvatar();
	
	$result = mysqli_query($conn, "SELECT username FROM users WHERE username = '$username'");
	if (mysqli_fetch_assoc(($result))) {
		echo "<script>alert('username sudah terdaftar');</script>";
		return false;
	}
	if($password !== $password2){
		echo "
			<script>alert('Password tidak sesuai');</script>
		";
		return false;
	}
	
	$password = password_hash($password, PASSWORD_DEFAULT);
	 
	mysqli_query($conn, "INSERT INTO users VALUES (not null,
	'$username', '$password','$avatarUser')");
	return mysqli_affected_rows($conn);
}

function deletePost($id) {
	 global $conn;
	 mysqli_query($conn, "DELETE FROM post WHERE IDPost = $id");
}	
function deleteTweet($id) {
	 global $conn;
	 mysqli_query($conn, "DELETE FROM tweet WHERE IDTweet = $id");
}	

function identify($id, $check){
	$check .= 'ToOther';
	if ($id == $check) {
		return 'Me';
	} else {
		return 'Other';
	}
}
function send($data){
	$MeOther = htmlspecialchars($data["MeOther"]);
	$OtherMe = htmlspecialchars($data["OtherMe"]);
	$chatText = htmlspecialchars($data["chatText"]);
	$identifyChat = htmlspecialchars($data["identify"]);
	
	global $conn;
 	$query = "INSERT INTO chat
			VALUES 
			(not null,'$MeOther','$OtherMe', '$chatText','$identifyChat')";

	mysqli_query($conn, $query);
	return mysqli_affected_rows($conn);
}

function update($data){
	$id = $data["id"];
	$username = htmlspecialchars($data["username"]);
	$fotoLama = htmlspecialchars($data["fotoLama"]);
	if($_FILES['Photo']['error']===4){
		$foto = $fotoLama;
	} else {
		$foto = uploadAvatar();
		
	}
	global $conn;
 	$query = "UPDATE users SET 
	 		username = '$username',
 			avatarUser = '$foto'
 			WHERE IDUser = $id
 		";

	mysqli_query($conn, $query);
	mysqli_query($conn, "UPDATE post SET WhoPosted = '$username' WHERE IDUser = $id ");
	return mysqli_affected_rows($conn);	
}

?>