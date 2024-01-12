Welcome
<?php
session_start();
echo $_SESSION['username']; ?>
<br>
<a href="index.php?action=logout">Logout</a> |
<!--<a href="change_profile.php">Change Profile</a>-->