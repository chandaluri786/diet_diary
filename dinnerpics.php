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
<h1>Dinner Recipes</h1>
<table>
<?php
$disp = $conn->prepare('select recipe_name,prep_time,cook_time,prep_time+cook_time as total_time,serves,calories from recipes where category = :cat');
$disp->execute(['cat' => 'dinner']);
$res = $disp->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
echo '<tr><td><a href="recipe_back.php?name='.$r->recipe_name.'">'.$r->recipe_name.'</a><br><p class = "aligned"><a href ="recipe_back.php?name='.$r->recipe_name.'"><img src = "'.strtolower($r->recipe_name).'.jpg"></a>Prep Time :'.$r->prep_time.' mins<br>Cook Time : '.$r->cook_time.' mins<br>Total Time: '.$r->total_time.' mins<br>Serves : '.$r->serves.'<br>Calories : '.$r->calories.'kcal per serving</p></td></tr>';}
?>
<!--<tr>
<td>
<a href = "stir fry.html">Bok Choy Stir Fry</a>
<p class = "aligned"><a href = "stir fry.html"><img src = "bok choy stir fry.jpg"></a>
Prep Time : 15 mins<br>Cook Time : 15 mins<br>Total Time : 30 mins<br>Serves : 2<br>Calories : 110kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href = "salad.html">Quinoa Superfood Salad</a><br>
<p class = "aligned"><a href = "salad.html"><img src = "quinoa-superfood-salad-bowl.jpg"></a>
Prep Time : 15 mins<br>Cook Time : 15 mins<br>Total Time : 30 mins<br>Serves : 4<br>Calories : 269kcal prer serving</p>
</td>
</tr>
<tr>
<td>
<a href = "kimchi bowl.html">Cauliflower Rice Kimchi Bowl</a>
<p class = "aligned"><a href = "kimchi bowls.html"><img src = "cauliflower rice kimchi bowls.jpg"></a>
Prep Time : 10 mins<br>Cook Time : 15 mins<br>Total Time : 25 mins<br>Serves : 4<br>Calories : 284kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href = "pasta.html">Pesto Pasta</a>
<p class = "aligned"><a href = "pasta.html"><img src = "pesto-pasta.jpg"></a>
Prep Time : 15 mins<br>Cook Time : 10 mins<br>Total Time : 25 mins<br>Serves : 2<br>Calories : 367kcal per serving</p>
</td>
</tr>
<tr>
<td>
<a href = "noodles.html">Sweet Potato Noodles</a>
<p class = "aligned"><a href = "noodles.html"><img src = "sweet potato noodles.jpg"></a>
Prep Time : 25 mins<br>Cook Time : 20 mins<br>Total Time : 45 mins<br>Serves : 4<br>Calories : 417kcal per serving</p>
</td>
</tr>-->
</table>
</body>
</html>
