<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
require_once 'header.php';
?>
<html>
<head>
<link rel = "stylesheet" href = "foodtable.css">
<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="sideNavigation.css">
<script src='https://kit.fontawesome.com/a076d05399.js'>--></script>
</head>
<body>
<div class="main">
<center>
<form action ="foodchart1.php" method="POST">
<input type = "text" id = "search box" class = "search" name = "Search" placeholder = "Search..."/>
<input type = "image" src = "search 1.png" >
</form>
</center>

<table>
<h3 align="center" style='color:blue;text-decoration:underline;font-weight:bold'>Food Chart</h3>
<th>Item_no</th><th>Item_name</th><th>Quantity(piece/cup/tbsp)</th><th>Calories(kcal)</th>
<!--
<tr>
<td>5</td><td>Chapati</td><td>1 piece</td><td>104kcal</td>
</tr>
<tr>
<td>6</td><td>Coffee</td><td>1 cup</td><td>192kcal</td>
</tr>
<tr>
<td>7</td><td>Dosa</td><td>1 piece</td><td>51.2kcal</td>
</tr>
<tr>
<td>8</td><td>Doughnuts</td><td>1 piece</td><td>250kcal</td>
</tr>
<tr>
<td>9</td><td>Ginger Chutney</td><td>1 tbsp</td><td>41kcal</td>
</tr>
<tr>
<td>10</td><td>Green Chutney</td><td>1 tbsp</td><td>14kcal</td>
</tr>-->
<?php
    $val = $_POST["Search"];
    if($val == NULL){
    $disp1 = $conn->prepare('select item_name,quantity,calories from food_chart order by item_name');
    $disp1->execute();
    $res = $disp1->fetchall(PDO::FETCH_OBJ);
    
    $num = 1;
   foreach ($res as $r)
   {
   echo"<tr><td>".$num++."</td><td>".$r->item_name."</td><td>".$r->quantity."</td><td>".$r->calories."</td></tr>";
   }
}
   else if ($val != NULL ){ $disp = $conn->prepare('select item_id,item_name,quantity,calories from food_chart where item_name = :item');
    $disp->execute(['item' => $val]);
    $post = $disp->fetch(PDO::FETCH_OBJ);
echo "<tr><td>".'1'."</td><td>".$post->item_name."</td><td>".$post->quantity."</td><td>".$post->calories."</td></tr>";
}

    
?>
</table>
</div>
<?php
require_once 'scripts.php';
?>
</body>
</html>
