<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: welcome.php");
    exit;
}
 
// Include config file
require_once "db_config.php";
 $conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE."", USER, PASS);
// Define variables and initialize with empty values
$username = $password = "";
$errors = array();
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
       array_push($errors, "Please enter username.");
    } else{
        $username = mysqli_real_escape_string($db,$_POST['username']);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
         array_push($errors, "Please enter your password.");
    } else{
       
    $password =  mysqli_real_escape_string($db,$_POST['password']);
    }
    
    // Validate credentials
    if(count($errors) ==0){
        // Prepare a select statement
        $stmt = $conn->prepare("SELECT username, password , active FROM users WHERE username = :name AND active = '1'");
		$stmt->bindParam(':name', $username);
		$stmt->execute();
        
       $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    //If $row is FALSE.
   if($user === false){
        //Could not find a user with that username!
        array_push($errors,'Username does not exists');
    } 
	else{
        //User account found. Check to see if the given password matches the
        //password hash that we stored in our users table.
        $validPassword = password_verify($password, $user['password']);
        
        //If $validPassword is TRUE, the login has been successful.
        if($validPassword){
                            $_SESSION["loggedin"] = true;
                           
                            $_SESSION["username"] = $username;                            
                            
                            // Redirect user to welcome page
                            header("location: welcome.php"); //vagy index.php
                        } 
	   else {
           array_push($errors,'Invalid password');
        }
		
   
    }
}
 }

//verify account after registration

if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	
	
    // Verify data
    $email = mysqli_real_escape_string($db,$_GET['email']); // Set email variable
    $hash = mysqli_real_escape_string($db,$_GET['hash']); // Set hash variable
     $conn = new PDO("mysql:host=".HOST.";dbname=".DATABASE."", USER, PASS);
	$stmt = $conn->prepare("SELECT email, hash, active FROM users WHERE email= :email AND hash= :hash AND active = '0'");
$stmt->bindParam(':email', $email);
$stmt->bindParam(':hash', $hash);
$stmt->execute();

                  
    if($stmt->rowCount() > 0){
        // We have a match, activate the account
       $sth = $conn->prepare("UPDATE users SET active='1' WHERE email=:email AND hash= :hash AND active='0'");
       $sth->bindParam(':email', $email);
	   $sth->bindParam(':hash', $hash);
	   $sth->execute();
		echo '<div >Your account has been activated, you can now login</div>';
    }else{
        // No match -> invalid url or account has already been activated.
        echo '<div>The url is either invalid or you already have activated your account.</div>';
    }
                  
}
//else{
    // Invalid approach
   // echo '<div class="statusmsg">Invalid approach, please use the link that has been sent to your email.</div>';
//}
?>
 
<!DOCTng="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p><?php include('errors.php'); ?>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" id="Username" class="form-control" value="">
                <span class="help-block"></span>
            </div>    
            <div class="form-group ">
                <label>Password</label>
                <input type="password" name="password" id="Password" class="form-control">
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <p>Don't have an account? <a href="register3.php">Sign up now</a>.</p>
        </form>
    </div>    
</body>
<script type="text/javascript">



</script>
</html>