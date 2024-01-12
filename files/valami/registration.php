<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Registration</title>
<link rel="stylesheet" href="../style/reg.css">
<link rel="stylesheet" href="../style/style.css">
<?php
	include_once("header.php");
	
	include('db_config.php');
?>


</head>

<body>
    <!-- start header div -->
    <div id="header">
        <h3></h3>
    </div>
    <!-- end header div -->  
      
    <!-- start wrap div -->  
    <div id="wrap">
          
        <!-- start php code -->
         <?php
		
		$name = "";
		$email = "";
		
		
		$db = new mysqli(HOST,USER,PASS,DATABASE);
		
		
          if(isset($_POST['name']) && !empty($_POST['name']) AND isset($_POST['email']) && !empty($_POST['email'])){
    			$username = mysqli_real_escape_string($db, $_POST['name']);
  				$email = mysqli_real_escape_string($db, $_POST['email']);
  				$password = mysqli_real_escape_string($db, $_POST['password']);
				 // Turn our post into a local variable
			  

			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$msg = "Invalid email format";
			}
			else{
					// Return Success - Valid Email
					$msg = 'Your account has been made, <br /> please verify it by clicking the activation link that has been send to your email.';
				
				$hash = password_hash( rand(0,1000), PASSWORD_BCRYPT ); // Generate random 32 character hash and assign it to a local variable.
// Example output: f4552671f8909587cf485ea990207f3b
		$password1 = password_hash( $password, PASSWORD_BCRYPT );
		//echo $hash;
		$query = mysql_query("INSERT INTO users (username, password, email, hash) VALUES(
'". mysqli_real_escape_string($db, $_POST['name']) ."', 
'". mysqli_real_escape_string($db, $_POST['password']) ."',  
'". mysqli_real_escape_string($db, $_POST['email']) ."') ");
		
		$to = $email;
		$subject = "validation/test";
		$message = 'Thanks for signing up!
Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
  
------------------------
Username: '.$name.'
Password: '.$password.'
------------------------
  
Please click this link to activate your account:
http://www.yourwebsite.com/verify.php?email='.$email.'&hash='.$hash.'
  
'; // Our message above including the link
                      
$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
		
mail($to, $subject, $message, $headers); // Send our email";
			}
		  }	
		
		
		?>
		
		
		
        <!-- stop php code -->
      
        <!-- title and description -->   
        <h3>Signup Form</h3>
        <p>Please enter your name and email addres to create your account</p>
          <?php 
    if(isset($msg)){  // Check if $msg is not empty
        echo '<div class="statusmsg">'.$msg.'</div>';} // Display our message and wrap it with a div with the class "statusmsg".
  ?>
        <!-- start sign up form -->  
        <form action="registration.php" method="post">
            <label for="name">Name:</label>
            <input type="text" name="name" value="" />
            <label for="email">Email:</label>
            <input type="text" name="email" value="" />
            <label for="password">Password:</label>
            <input type="password" name="password" value="" />
            <label>Confirm password</label>
  	  		<input type="password" name="password_2">
            <label>Postal code / Zip code</label>
  	 		<input type="text" name="zip">
              
            <input type="submit" class="submit_button" value="Sign up" name="submit"/>
            
        </form>
        <!-- end sign up form -->
          
    </div>
    <!-- end wrap div -->
</body>
</html>
