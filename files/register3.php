<!doctype html>
<?php
require 'db_config.php';

// initializing variables

$username = "";
$email    = "";
$phone = "";
$zip = "";
$city = "";
$address = "";
$hash = "";
$errors = array();
// Create connection
$conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE."", USER, PASS);


session_start();
//include('connection.php');
if(isset($_POST['buttonSave'])) {
	$username = mysqli_real_escape_string($db, $_POST['username']);
  	$email = mysqli_real_escape_string($db, $_POST['email']);
  	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$zip = mysqli_real_escape_string($db, $_POST['zip']);
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {	array_push($errors, "The two passwords do not match");
  }

$stmt = $conn->prepare("SELECT username, email FROM users WHERE username = :name OR email= :email");
$stmt->bindParam(':name', $username);
$stmt->bindParam(':email', $email);
$stmt->execute();

if($stmt->rowCount() > 0){
    array_push($errors,"exists! cannot insert");
} 
		if(count($errors) == 0) {
			
	$hash = password_hash(rand(1000,10000), PASSWORD_BCRYPT);	
	$password = password_hash($_POST['password_1'], PASSWORD_BCRYPT);
			
    $stmt = $conn->prepare('INSERT INTO users(username, email, password, hash, phone, zip, city, address) values(:username, :email, :password, :hash, :phone, :zip, :city, :address)');
	$stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
	$stmt->bindValue(':email', $email, PDO::PARAM_STR);
	$stmt->bindValue(':password', $password, PDO::PARAM_STR);
	$stmt->bindValue(':hash', $hash, PDO::PARAM_STR);
	$stmt->bindValue(':phone', $phone, PDO::PARAM_INT);
	$stmt->bindValue(':zip', $zip, PDO::PARAM_INT);
	$stmt->bindValue(':city', $city, PDO::PARAM_STR);
	$stmt->bindValue(':address', $address, PDO::PARAM_STR);
	$stmt->execute();
			
			
	$_SESSION['username'] = $username; //Igazabol nem fontos
  	$_SESSION['success'] = "You are now registered"; //ez se
			
	$to = $email;
		$subject = "validation/test";
		$message = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
------------------------
Username: '.$username.'
Password: '.$password_1.'
Phone: '.$phone.'
Zip: '.$zip.'
City: '.$city.'
Address: '.$address.'
------------------------
  
Please click this link to activate your account:
http://localhost/projekt2020_II/files/login4.php?email='.$email.'&hash='.$hash.'
  
'; // Our message above including the link
                      
$headers = 'From:noreply@skynet.com' . "\r\n"; // Set from headers
		
mail($to, $subject, $message, $headers);
	  
	  
  	header('location: login4.php');		
	}

}

?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../style/reg1.css">
</head>
<body>
  <div class="header">
  	<h2>Register</h2>
  </div>
   <form method="post" action="register3.php">
  	<?php include('errors.php'); ?>
  	<div class="input-group">
  	  <label>Username</label>
  	  <input type="text" name="username">
  	</div>
  	<div class="input-group">
  	  <label>Email</label>
  	  <input type="email" name="email" >
  	</div>
  	<div class="input-group">
  	  <label>Password</label>
  	  <input type="password" name="password_1">
  	</div>
  	<div class="input-group">
  	  <label>Confirm password</label>
  	  <input type="password" name="password_2">
  	</div>
  	<div class="input-group">
  	  <label>Postal code / Zip code</label>
  	  <input type="text" name="zip">
  	</div>
  	<div class="input-group">
  	  <label>City</label>
  	  <input type="text" name="city">
  	</div>
  	<div class="input-group">
  	  <label>Address</label>
  	  <input type="text" name="address">
  	</div>
  	<div class="input-group">
  	  <label>Phone</label>
  	  <input type="tel" name="phone">
  	</div>
  	<div class="input-group">
  	  <button type="submit" class="btn" name="buttonSave">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="login4.php">Sign in</a>
  	</p>
  </form>

</body>
</html>