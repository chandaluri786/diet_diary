<?php
session_start();
require_once 'connection.php';
?>
<html>
<head>
<link rel = "stylesheet" href = "table.css">
<link rel = "stylesheet" href = "picslist.css">
</head>
<body>
<h1>Lunch Recipes</h1>
<table>
<?php
$disp = $conn->prepare('select recipe_name,prep_time,cook_time,prep_time+cook_time as total_time,serves,calories from recipes where category = :cat');
$disp->execute(['cat' => 'lunch']);
$res = $disp->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
echo '<tr><td><a href="recipe_back.php?name='.$r->recipe_name.'">'.$r->recipe_name.'</a><br><p class = "aligned"><a href ="recipe_back.php?name='.$r->recipe_name.'"><img src = "'.strtolower($r->recipe_name).'.jpg"></a>Prep Time :'.$r->prep_time.' mins<br>Cook Time : '.$r->cook_time.' mins<br>Total Time: '.$r->total_time.' mins<br>Serves : '.$r->serves.'<br>Calories : '.$r->calories.'kcal per serving</p></td></tr>';}
?>
<!--<tr>
<td>
<a href = "broccoli salad.html">Broccoli Salad</a><br>
<p class = "aligned"><a href = "broccoli salad.html"><img src = "broccoli-salad.jpg"></a>
Prep Time : 10 mins<br> Cook Time : 15 mins<br>Total Time : 25 mins<br>Serves : 4 to 6<br>Calories : 196kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href="soup.html">Roasted Red Pepper Soup</a><br>
<p class = "aligned"><a href = "soup.html"><img src = "roasted red pepper soup.jpg"></a>
Prep Time : 10 mins<br>Cook Time : 35 mins<br>Total Time : 45 mins<br>Serves : 4<br>Calories : 320kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href = "falafel.html">Crispy Baked Falafel</a><br>
<p class = "aligned"><a href = "falafel.html"><img src = "falafel.jpg"></a>
Prep Time : 15 mins<br>Cook Time : 25 mins<br>Total Time : 40 mins<br>Serves : 4<br>Calories : 333kcal per serving</p>
</tr>
</td>
<tr>
<td>
<a href = "tuna salad.html">Tuscan White Bean & Tuna Salad</a><br>
<p class = "aligned"><a href = "tuna salad.html"><img src = "White-bean-and-Tuna-Salad.jpg"></a>
Prep Time : 15 mins<br>Total Time : 15 mins<br>Serves : 2<br>Calories : 367kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href = "sandwich.html">Veggie Sandwich</a><br>
<p class = "aligned"><a href = "sandwich.html"><img src = "veggie sandwich.jpg"></a>
Prep Time : 20 mins<br>Cook Time : 40 mins<br>Total Time : 1 hour<br>Serves : 4<br>Calories : 468kcal per serving</p>
</td>
</tr>-->
</table>
</body>
</html>
