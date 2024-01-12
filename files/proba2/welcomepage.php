<?php
session_start();
if(isset($_GET['action']) && $_GET['action'] == 'logout') {
    unset($_SESSION['username']);
    header('location:index.php');
}
?>

Welcome <?php echo $_SESSION['username']; ?>
<br>
<a href="index.php?action=logout">Logout</a> |
<a href="change_profile.php">Change Profile</a>