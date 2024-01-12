<?php
session_start();
include('connection.php');
if(isset($_POST['buttonSave'])) {
    $stmt = $conn->prepare('insert into users(username, email, password) values(:username, :email, :password,)');
	$stmt->bindValue(':username', $_POST['username'], PDO::PARAM_STR);
	$stmt->bindValue(':email', $_POST['email']);
	$stmt->bindValue(':password', password_hash($_POST['password'], PASSWORD_BCRYPT));
	$stmt->execute();
	header('location:index.php');
}

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form method="post">
        <table>
            <tr>
                <td>Username</td>
                <td>
                    <input type="text" name="username">
                </td>
            </tr>
            <tr>
                <td>Password</td>
                <td>
                    <input type="password" name="password">
                </td>
            </tr>
            <tr>
                <td>Full Name</td>
                <td>
                    <input type="text" name="fullName">
                </td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td>
                    <input type="submit" value="Save" name="buttonSave">
                </td>
            </tr>
        </table>
</body>
</html>