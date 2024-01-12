<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title><?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "csiki sor szerbia";

//try{
	$db = new PDO("msql:host={$host};dbname={$dbname}",$user,$pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//}
//catch(PDOException $e){
	//$e->getMessage();
//}


?>
<?php



if(isset($_REQUEST['btn_register'])){
	$username = strip_tags($_REQUEST['txt_username']);
	$email = strip_tags($_REQUEST['txt_email']);
	$password = strip_tags($_REQUEST['txt_password']);
	
	if(empty($username)){
		$errorMsg[] = "please enter username or email";
	}
	else if(empty($email)){
		$errorMsg[] = "please enter username or email";
	}
	else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
		$errorMsg[] = "Please enter a valid email address";
	}
	else if(empty($password)){
		$errorMsg[] = "please enter password";
	}
	else if(strlen($password) < 6){
		$errorMsg[] = "Password must be at least 6 characters";
	}
	else{
		try{
			$select_stmt=$db->prepare("SELECT username, email FROM users WHERE username=:username OR email=:email");
			
			$select_stmt=$db->execute(array(':username'=>$username,'email'=>$email));
			$row=$select_stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row['username'] ==$username){
				$errorMsg[]="Username alredy exists";
			}
			else if($row['email'] ==$email){
				$errorMsg[]="Email alredy exists";
			}
			else if(!isset($errorMsg)){
				$new_password = password_hash($password, PASSWORD_BCRYPT);
				
				if($insert_stmt->execute(array(':username'=>$username,
										   ':email'=>$email,
										   ':password'=>$password,))){
					$registerMsg = "register succeccfully Please click on login account link";
				}
			}
		}
		catch(PDOException $e){
			echo $e->getMessage();
		}
	}
}
?>
</head>
<body>

<form method="post" class="form-horizontal">
	<div class="form-group">
		<label class="col-sm-3 control-label">Username</label>
		<div class="col-sm-6">
			<input type="text" name="txt_username" class="form-control" />
		</div>
	</div>
	
	<div class="form-group">
		<label class="col-sm-3 control-label">Email</label>
		<div class="col-sm-6">
			<input type="text" name="txt_email" class="form-control" placeholder="enter emial"/>
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
			<input type="submit" name="btn_register" class="btn btn-success" value="register" />
		</div>
	</div>
	
	
	
</form>
</body>
</html>