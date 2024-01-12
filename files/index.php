<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="description" content="Free Web tutorials">
	<meta name="keywords" content="csíki sör, sör, maláta, kézműves sör, pivo">
	<meta name="author" content="Csíki Sör Szerbia d.o.o.">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Csíki Sör Szerbia</title>
	<link rel="stylesheet" href="../style/style.css">
	<link href="http://fonts.googleapis.com/css?family=Cookie" rel="stylesheet" type="text/css">
	
	<?php
	if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    echo"YEEEEEEE";
    exit;
}?>
	
<?php
session_start();
if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['username']);
	unset($_SESSION['loggedin']);
    header('location:index.php');
}?>

</head>
<body>	
	
<div class="header">
	<div class="container">
		<?php include_once("header.php");?>
		<div class="row">
			<div class="col-2">
				<h1>Ismerd meg a kézműves sörök világát,<br>egy új világot</h1>
			</div>
		</div>
	</div>
	<div class="button">
		<a class="btn" href="#rolunk">Felfedezés</a>
	</div>
</div>
<div class="col-4" id="rolunk">
  <h2>Rólunk</h2>
  	<div class="txt1">
  		<p>A Csíki Sör Manufaktúrában száznál több székely ember dolgozik. Együttműködve a Sapientia Erdélyi Magyar Tudományegyetemmel, kutatva, tisztelve és felelevenítve közös múltunkat, mi magunk alakítjuk ki és folyamatosan bővítjük receptjeinket. Helyben szervezzük meg a sörfőzési és palackozási feladatokat, és mi magunk gondoskodunk arról is, hogy friss, különleges söreink a boltokba és vendéglátó egységekbe, ezáltal reményeink szerint az Ön asztalára is eljussanak.<br><br>
		Termékeink 100%-ban tartalmaznak székely értékeket és életérzést.</p>
	</div>
	<div class="txt2">
		<ul>
			<li><img src="../images/malt-4950433_1920.jpg"></li>
			<li><img src="../images/barrel-4429225_1280.jpg"></li>
		</ul>
	
	
	</div>

</div>
<div class="col-4" id="elerhetosegek">
	<h2>Elérhetőségeink</h2>
</div>
  <div id="contact">
  	<h1>Send Us A MESSAGE</h1>
  	<form action="index.php" method="post" id="contact_form">
    	<div class="name">
      		<label for="name"></label>
      		<input type="text" placeholder="Name" name="name" id="name_input" required>
    	</div>
    	<div class="email">
      		<label for="email"></label>
      		<input type="email" placeholder="E-mail" name="email" id="email_input" required>
    	</div>
    	<div class="telephone">
      		<label for="name"></label>
      		<input type="text" placeholder="Phone number" name="telephone" id="telephone_input" required>
    	</div>
    	<div class="subject">
      		<label for="subject"></label>
      		<select placeholder="Subject" name="subject" id="subject_input" required>
        		<option disabled hidden selected>Subject</option>
       		 	<option>I'd like to start a project</option>
        		<option>I'd like to ask a question</option>
        		<option>I'd like to make a proposal</option>
      		</select>
    	</div>
    	<div class="message">
     	 	<textarea name="message" placeholder="Type here you're meesage" id="message_input" cols="30" rows="5" required></textarea>
    	</div>
    	<div class="submit">
      		<input type="submit" value="Send Message" id="form_button" />
    	</div>
  	</form>
  </div>

<footer class="footer-container">
 
	<div class="footer-left">		
		<h3>Csíki Sör Szerbia</h3>
	</div>
 
	<div class="footer-center"> 
		<div>
			<i class="fa fa-map-marker"></i>
			<p><span>41 karadjordjeva</span> Senta, Serbia</p>
		</div>
 
		<div>
	 		 <i class="fa fa-phone"></i>
	  		<p>+381 0631549642</p>
		</div>
 
		<div>
	 		 <i class="fa fa-envelope"></i>
	 		 <p><a href="">csiki_support@gmail.com</a></p>
		</div>
 
	</div>
 
	<div class="footer-right">
		<div class="footer-icons"> 
			<a href="#"><i class="fa fa-facebook"></i></a>
			<a href="#"><i class="fa fa-twitter"></i></a>
			<a href="#"><i class="fa fa-linkedin"></i></a> 
		</div> 
	</div> 
</footer>

</body>
</html>