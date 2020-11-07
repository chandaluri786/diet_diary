<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
//require_once 'topNavigation.php';
require_once 'header.php';
?>
<html>
<head>
<link rel = "stylesheet" href="table.css">
<link rel = "stylesheet" href ="picslist.css">
</head>
<body>
    <div class="main">
<h1><?php echo ucwords($_GET['category'])?> Recipes</h1>
<table>
<?php
$disp = $conn->prepare('select recipe_name,prep_time,cook_time,prep_time+cook_time as total_time,serves,calories from recipes where category = :cat');
$disp->execute(['cat' => $_GET['category']]);
$res = $disp->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
echo '<tr><td><a href="recipe_back.php?name='.$r->recipe_name.'">'.$r->recipe_name.'</a><br><p class = "aligned"><a href ="recipe_back.php?name='.$r->recipe_name.'"><img src = "'.strtolower($r->recipe_name).'.jpg"></a>Prep Time :'.$r->prep_time.' mins<br>Cook Time : '.$r->cook_time.' mins<br>Total Time: '.$r->total_time.' mins<br>Serves : '.$r->serves.'<br>Calories : '.$r->calories.'kcal per serving</p></td></tr>';}
?>
<!--<tr>
<td>
<a href="french toast.html">Classic French Toast</a><br>
<p class = "aligned"><a href = "french toast.html"><img src = "hbr22.jpg"></a>
Prep Time : 6 mins<br>Cook Time : 16 mins<br>Total Time : 22 mins<br>Serves : 4<br>Calories : 180kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href="breakfast bowl.html">Farmers Market Breakfast Bowl</a><br>
<p class = "aligned"><a href = "breakfast bowl.html"><img src = "hbr11.jpg"></a>
Prep Time : 20 mins<br>Cook Time : 10 mins<br>Total Time : 30 mins<br>Serves : 2 large servings<br>Calories : 218kcal per serving</p>
</tr>
</td>
<tr>
<td>
<a href = "overnight oats.html">Overnight Oats</a><br>
<p class = "aligned"><a href = "overnight oats.html"><img src = "bfr4.jpg"></a>
Prep Time : 5 mins<br>Total Time : 5 mins<br>Serves : 1<br>Calories : 244kcal</p>
</tr>
</td>
<tr>
<td>
<a href = "frittata.html">Frittata</a><br>
<p class = "aligned"><a href = "frittata.html"><img src = "bfr02.jpg"></a>
Prep Time : 5 mins<br> Cook Time : 25 mins<br>Total Time : 30 mins<br>Serves : 3 to 4<br>Calories : 257kcal per serving</p>
</tr>
</td>-->
</table></div>
<?php
require_once 'scripts.php';
?>
</body>
</html>
