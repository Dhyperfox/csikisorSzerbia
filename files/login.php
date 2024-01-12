<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
<link rel="stylesheet" href="../style/login_style.css">
</head>

<body>
 <div class="loginbox">
<form action="process.php" method="post">
	
	<h1>Login</h1>

	<div class="textbox">
	 <div class="again">
	<?php
if (isset($_GET["msg"]) && $_GET["msg"] == 'failed'){
	echo "<div class='again'>Wrong Username / Password</div>";
}
	?>
	 </div>
	<i class="fas fa-user"></i>
		<input type="text" id="user"	placeholder="Username"	 name="user" value="" required>		
	</div>
	<div class="textbox">
	<i class="fas fa-key"></i>
		<input type="Password" id="pass"	placeholder="Password"	 name="pass" value="" required>		
	</div>
	<label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
	<input class="btn" id="btn" type="submit" name="" value="Sign in">
</form>	
</div>
</body>
</html>