<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
require_once 'header.php';
?>
<html>
<head>
<link rel = "stylesheet" href = "recipe_back.css">
</head>
<body>
    <div class="main">
<?php
$var = $_GET['name'];
$num = 1;
$disp = $conn->prepare('select * from recipes inner join recipe_ingredients on recipes.recipe_id = recipe_ingredients.recipe_id where recipe_name = :name');
$disp->execute(['name' => $var]);
$res = $disp->fetchAll(PDO::FETCH_OBJ);
echo '<h1>'.$var.'</h1>';
echo '<h3>Ingredients</h3>';
foreach($res as $r){
echo '<p>'.$num++.') '.$r->ingredients.'</br></p>';
}
$disp1 = $conn->prepare('select * from recipes inner join recipe_procedures on recipes.recipe_id = recipe_procedures.recipe_id where recipe_name = :name');
$disp1->execute(['name' => $var]);
$res1 = $disp1->fetchAll(PDO::FETCH_OBJ);
echo '<h3>Procedure</h3>';
foreach($res1 as $r){
echo '<p>'.$r->procedures.'</br></p>';
}
$num = 1;
$disp1 = $conn->prepare('select * from recipes inner join recipe_benefits on recipes.recipe_id = recipe_benefits.recipe_id where recipe_name = :name');
$disp1->execute(['name' => $var]);
$res1 = $disp1->fetchAll(PDO::FETCH_OBJ);
echo '<h3>Benefits</h3>';
foreach($res1 as $r){
echo '<p>'.$num++.') '.$r->benefits.'</br></p>';
}
?>
</div>
<?php
require_once 'scripts.php';
?>
</body>
</html>
