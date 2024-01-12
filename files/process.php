<?php
if (isset($_POST['user']))
{
$username = $_POST['user'];
$password = $_POST['pass'];
$conn = mysqli_connect("localhost", "root", "","csiki sor szerbia");
$username1 = stripcslashes($username);
$password1 = stripcslashes($password);
$username = mysqli_real_escape_string($conn,$username1);
$password = mysqli_real_escape_string($conn,$password1);
echo $username;
echo $password;
//mysqli_select_db("tbl");
$sql = "select * from user where username = '$username' && password='$password'";
//$result = $conn->query($sql) or die($conn->error);
$result = mysqli_query($conn,$sql) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1){
	    $_SESSION['username'] = $username;
            // Redirect user to index.php
	    header("Location: termekek.php");
         }else{
			header("location: loginpage.php?msg=failed");
					/*echo "<div class='form'>
<h3>Username/password is incorrect.</h3>
<br/>Click here to <a href='loginpage.php'>Login</a></div>";*/
	}
    

} else {
	
	Echo "NO NO";
	   
	   }
	

?>


