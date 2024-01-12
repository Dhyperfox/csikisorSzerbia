<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "csiki sor szerbia";

try{
	$db = new PDO("msql:host={$host};dbname={$dbname}",$user,$pass);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e){
	$e->getMessage();
}


?>