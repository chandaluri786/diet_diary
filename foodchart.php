<?php
require_once 'connection.php';
?>
<html>
<head>
<link rel = "stylesheet" href = "food table.css">
</head>
<body>
<center>
<input type = "text" id = "search box" class = "search" name = "Search" placeholder = "Search..."/>
<input type = "image" src = "search 1.png" ">
</center>
</form>
<table>
<caption>Food Chart</caption>
<th>Item_no</th><th>Item_name</th><th>Quantity</th><th>Calories</th>
<!--<tr>
<td>1</td><td>Aloo Paratha</td><td>1 piece</td><td>222kcal</td>
</tr>
<tr>
<td>2</td><td>Appam</td><td>1 piece</td><td>99kcal</td>
</tr>
<tr>
<td>3</td><td>Boiled Egg</td><td>1 cup(chopped)</td><td>211kcal</td>
</tr>
<tr>
<td>4</td><td>Bread</td><td>1 piece</td><td>99kcal</td>
</tr>
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
    
    $disp = $conn->prepare('select item_id,item_name,quantity,calories from food_chart');
    $disp->execute();
    $res = $disp->fetchall(PDO::FETCH_OBJ);
    
   foreach ($res as $r)
   {
   echo"<tr>"."<td>".$r->item_id."</td><td>".$r->item_name."</td><td>".$r->quantity."</td><td>".$r->calories."</td></tr>";
   }

?>

</table>
</body>
</html>