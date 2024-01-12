<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Admin-page</title>
<link rel="stylesheet" href="../style/admin.css"
</head>


<body>
<?php include_once("header.php");               
	  include "db_config.php"; ?>

<?php 
	$connect = new mysqli(HOST,USER,PASS,DATABASE);
if($connect -> connect_errno) {
    echo $connect -> connect__error;
}
	$limit = "LIMIT 3";
	$name ="";
	$category="";
	$price="";
	
	
   if(isset($_POST['delete']))
   {
		$checkbox = $_POST['check'];
		for($i=0;$i<count($checkbox);$i++)
		{
		
			$del_id = $checkbox[$i]; 
			mysqli_query($connect,"DELETE FROM products WHERE id='".$del_id."'");
			$message = "Data deleted successfully !";
		
		}
	   $result = mysqli_query($connect,"SELECT * FROM products"." $limit");
   }
$result = mysqli_query($connect,"SELECT * FROM products"." $limit");
	
	
	if(isset($_POST["new"]))
	{
		if(isset($_POST["new_name"]) or isset( $_POST["new_category"]) or isset( $_POST["new_price"]))
		{
	 		$name = $_POST["new_name"];
	 		$category =  $_POST["new_category"];
			$price = $_POST["new_price"];
		}
		$sql = "INSERT INTO products (name, category, price, availability)
		VALUES ( '$name', '$category', '$price', '1')";

		if ($connect->query($sql) === TRUE)
  			echo "New record created successfully";
  			$result = mysqli_query($connect,"SELECT * FROM products"." $limit");
			$connect->close();
	}
	
	if(isset($_POST['update']))
	{
		if(isset($_POST["new_name"]) or isset( $_POST["new_category"]) or isset( $_POST["new_price"]))
		{
	 		$name = $_POST["new_name"];
	 		$category =  $_POST["new_category"];
	 		$price = $_POST["new_price"];
		}
		$checkbox = $_POST['check'];
		for($i=0;$i<count($checkbox);$i++)
		{
		$update_id = $checkbox[$i]; 
		mysqli_query($connect,"UPDATE products SET name='$name', category='$category', price='$price' WHERE id='".$update_id."'");
		}

		$message = "Data updated successfully !";
		$result = mysqli_query($connect,"SELECT * FROM products"." $limit");
	}
	
	if(isset($_POST["limit"]))
	{
		$result = mysqli_query($connect,"SELECT * FROM products");
	}
?>

<div class="message"><?php if(isset($message)) { echo $message; } ?>
</div>
<form method="post" action="">
<table class="table">
<thead>
<tr>
    <th><input type="checkbox" id="checkAl">Összes</th>
	<th>Id</th>
	<th>Név</th>
	<th>Kategória</th>
	<th>Egységár</th>
</tr>
</thead>
<!-- ertekek kiiratasa -->
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
?>
<tr>
    <td><input type="checkbox" id="checkItem" name="check[]" value="<?php echo $row["id"]; ?>"></td>
	<td><?php echo $row["id"]; ?></td>
	<td><?php echo $row["name"]; ?></td>
	<td><?php echo $row["category"]; ?></td>
	<td><?php echo $row["price"]."din."; ?></td>
</tr>
<?php
	$i++;
}
?>
</table>
<p align="center">
	<button type="submit"  name="delete">DELETE</button>
	<button type="submit"  name="new">NEW</button>
	<button type="submit"  name="update">UPDATE</button>
	<button type="submit"  name="limit">LIST</button>
</p>

<div class="inputs">
<div class="upname">
	<label for="new_name">Termék neve:</label>
	<input type="text" name="new_name"></div>
	<div class="category">
		<label for="category">Kategória:</label>
		<select id="category" name="new_category">
			<option value="uveges">Uveges</option>
			<option value="dobozos">Dobozos</option>
		</select>
	</div>
	<div class="new_priceprice">
		<label for="new_price">Egységár:</label>
		<input type="number" name="new_price">
	</div>
</div>
</form>

</body>
</html>