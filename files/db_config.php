<?php 
define('HOST', 'localhost');
define('USER', 'root');
define('PASS', '');
define('DATABASE', 'csiki sor szerbia current');

$db = mysqli_connect(HOST, USER, PASS, DATABASE);
// Check connection
if($db === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
?>