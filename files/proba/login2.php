<?php 
include('server.php');
$password2 = "";

if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['password']) && !empty($_POST['password'])) {
    $username =  mysqli_real_escape_string($db,$_POST['username']);
	$password =  mysqli_real_escape_string($db,$_POST['password']);
	$password = password_hash($password, PASSWORD_BCRYPT);
	echo $password;
	echo "<br>";
	
	// Set variable for the username
 $query = "SELECT password FROM users WHERE  username = '" . $username . "'";
    $result = mysqli_query($db,$query);
	while ($row = mysqli_fetch_assoc($result)) {
   		$password2 = $row["password"];
		echo $password2;
}
   if($password == $password2){
	   header('index.php');
   }
	else{
		echo"Wrong Username or password";
	}
	
	//$password_hash = (isset($result['password']) ? $result['password'] : '');
    //$result = password_verify($_POST['password'], $password2);
}