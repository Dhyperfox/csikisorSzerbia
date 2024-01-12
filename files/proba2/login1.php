<?php
session_start();
session_start();
$conn = new PDO('mysql:host=localhost;csiki sor szerbia', 'root', '');


if(isset($_POST['buttonLogin'])) {
    $stmt = $conn->prepare('select * from usersaccount where username = :username');
	$stmt->bindValue('username', $_POST['username']);
	$stmt->execute();
	$account = $stmt->fetch(PDO::FETCH_OBJ);
    if($account != NULL) {
        if (password_verify($_POST['password'], $account->password)){
            $_SESSION['username'] = $_POST['username'];
            header('location:welcome.php');
        } else {
            $error = 'Account Invalid';
        }
    } else {
        $error = 'Account Invalid';
    }
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
        <?php echo isset($error) ? $error : ''; ?>
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
                <td>&nbsp;</td>
                <td>
                    <input type="submit" value="Login" name="buttonLogin">
                    <br>
                    <a href="register.php">Sign Up</a>
                </td>
            </tr>
        </table>
    </form>
</body>
</html>