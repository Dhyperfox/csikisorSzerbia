<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>


<?php

require 'connection.php';

session_start();
if(isset($_SESSION["user_login"])){
	header("location: welcome.php");
}

if(isset($_REQUEST['btn_login'])){
	$username = strip_tags($_REQUEST["txt_username_email"]);
	$email = strip_tags($_REQUEST["txt_username_email"]);
	$password = strip_tags($_REQUEST["txt_password"]);
	
	if(empty($username)){
		$errorMsg[] = "please enter username or email";
	}
	else if(empty($email)){
		$errorMsg[] = "please enter username or email";
	}
	else if(empty($password)){
		$errorMsg[] = "please enter password";
	}
	else{
		try{
			$select_stmt=$db->prepare("SELECT * FROM users WHERE username=:uesrname OR email=:email");
			$select_stmt->execute(array(':username'=>$username, ':email'=>$email));
			$row = $select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($select_stmt->rowCount()>0){
				if($username==$row["username"] OR $email==$row["email"]){
					if(password_verify($password, $row["password"])){
						$_SESSION["user_login"] = $row["id"];
						$loginMsg = "Successfull Login";
						header("refresh:2; welcome.php");
					}
					else{
						$errorMsg[]="wrong password"; 
					}
				}
				else{
						$errorMsg[]="wrong email"; 
					}
			}
			else{
						$errorMsg[]="wrong username"; 
					}
		}
		catch(PDOException $e){
			$e->getMessage();
		}
	}

}

?>


</head>

<body>
<form method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-3 control-label">Username or Email</label>
		<div class="col-sm-6">
			<input type="text" name="txt_username_email" class="form-control" placeholder="enter username or email"/>
		</div>
	</div>
	
		<div class="form-group">
		<label class="col-sm-3 control-label">Password</label>
		<div class="col-sm-6">
			<input type="password" name="txt_password" class="form-control" placeholder="enter password"/>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-3 col-sm-9 m-t">
			<input type="submit" name="btn_login" class="btn btn-success" value="Login" />
		</div>
	</div>
	
	
	
</form>

</body>
</html>