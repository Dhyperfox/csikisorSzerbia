  
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Termékek</title>
    <link rel="stylesheet" href="../style/style_termekek.css">
</head>
                 
<?php 

require_once 'db_config.php';

$connect = new mysqli(HOST,USER,PASS,DATABASE);
if($connect -> connect_errno) {
    echo $connect -> connect__error;
}

$sql_str = "";

/*--SEARCH--*/
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $connect->real_escape_string($_GET['search']);
    $search_arr = explode(' ', $search); // explode search string to "words"
    }
    if (isset($search_arr) && !empty($search_arr)) {
        $where = array();
        foreach ($search_arr as $key => $value) {
            $where[] = "WHERE name LIKE '%$value%' OR category LIKE '%$value%' OR price LIKE '%$value%'";
        }
        $sql_str .= implode(' OR ', $where);
    }


if (isset($sql_str)) {
    $sql = "SELECT * FROM products " . $sql_str;
    if ($result = $connect -> query($sql)) {
        while ($row = $result -> fetch_assoc()) {
            $products[] = $row;
        }
    }
}
?>




<body>

<div class="topnav">

 	<a href="index.php"><img src="../images/csiki_logo_200x71.png"></a>


 <div class="links">

 	<ul>
 		<li><a href="index.php?">Kezdőlap</a></li>
 		<li><a href="index.php?#rolunk">Rólunk</a></li>
 		<li><a href="termekek.php">Termékek</a></li>
 		<li><a href="index.php?#elerhetosegek">Elérhetőség</a></li>
 		<li><a href="admin.php">Bejelentkezés</a></li>
 		<li> <form class="search" method="get">
             	<input type="text" placeholder="Ár, Kategória vagy Név" name="search" >  
            	<button type="submit">Keresés</button>
         	 </form>
    	</li>
 	</ul>

 </div>
</div>           
    <section class="product-list block">            
            <div class="product-list__content">
                <?php
                    if (!empty($products))
					{  
                        foreach ($products as $key => $value)
						{
                            echo '<div class="product-list__item">
                                <img src="'.$value['photo'].'" class="product-list__picture" width="250px" alt="termek.jpg">
                                <div >'.'kategoria: ' .$value['category'].'</div>
                                <div >'.$value['name'].'</div>
                                <div >'.$value['price'].' din.</div>
                            	</div>';  
                        }
                    }
                    else 
					{
                        echo '<p class="products-error"> Products not found </p>';
                    }
                ?>
            </div>        
    </section>
</body> 
</html>