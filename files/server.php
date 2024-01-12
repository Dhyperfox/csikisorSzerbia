<?php
require 'db_config.php';
session_start();

// initializing variables
$username = "";
$email    = "";
$phone = "";
$zip = "";
$city = "";
$address = "";
$errors = array(); 

// connect to the database
$db = new mysqli(HOST,USER,PASS,DATABASE);

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  	$username = mysqli_real_escape_string($db, $_POST['username']);
  	$email = mysqli_real_escape_string($db, $_POST['email']);
  	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
	$phone = mysqli_real_escape_string($db, $_POST['phone']);
	$zip = mysqli_real_escape_string($db, $_POST['zip']);
	$city = mysqli_real_escape_string($db, $_POST['city']);
	$address = mysqli_real_escape_string($db, $_POST['address']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Username already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = password_hash($password_1, PASSWORD_BCRYPT);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, email, password, phone, zip, city, address) 
  			  VALUES('$username', '$email', '$password', '$phone', '$zip', '$city', '$address')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
  	$_SESSION['success'] = "You are now logged in";
	  
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
http://localhost/projekt2020_II/files/index.php?email='.$email.'&hash='.$password.'
  
'; // Our message above including the link
                      
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
		
mail($to, $subject, $message, $headers);
	  
	  
  	header('location: index.php');
  }
}
/* LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($username)) {
  	array_push($errors, "Username is required");
	 header('location: login1.php');
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
	  header('location: login1.php');
  }

  if (count($errors) == 0) {
  	$password = password_hash($password, PASSWORD_BCRYPT); //A jelszoval valami gond van
	  
  	$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
  	  $_SESSION['username'] = $username;
  	  $_SESSION['success'] = "You are now logged in";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Wrong username/password combination");
  	}
  }
}*/

?>
