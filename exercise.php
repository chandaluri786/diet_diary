<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
require_once 'header.php';
?>
<html>
<head>
<link rel = "stylesheet" href = "ex_back.css">
</head>
<body>
<div class="main">
<table>
   
<h1 align="center" style='color:blue;text-decoration:underline;font-weight:bold'>Excercises</h1>
<?php
$disp = $conn->prepare('select * from exercise');
$disp->execute();
$res = $disp->fetchAll(PDO::FETCH_OBJ);
foreach($res as $r){
echo '<tr><td><p>'.$r->exercise_name.'</p><br><iframe src="https://www.youtube.com/embed/'.$r->links.'" allowfullscreen></iframe>';
echo '<p class = "cal">Calories burnt(in cal per 15 minutes): '.$r->calories_burnt.'</p>';
$disp1 = $conn->prepare('select * from exercise inner join exercise_benefits on exercise.exercise_id = exercise_benefits.exercise_id where exercise.exercise_id = :id');
$disp1->execute(['id' => $r->exercise_id]);
$res1 = $disp1->fetchAll(PDO::FETCH_OBJ);
echo '<h2>Benefits</h2>';
echo '<div class="change"><ul type ="circle">';
foreach($res1 as $r1){
echo '<li>'.$r1->benefits.'</li>';
}
echo '</ul>';
echo '</div></td></tr>';
}
?>
<!--<td><p>Exercise 2</p><br><iframe src="https://www.youtube.com/embed/E1MLfbD5i8A" allowfullscreen></iframe></td>-->
</tr>
</table>
</div>
<?php
require_once 'scripts.php';
?>
</body>
</html>
