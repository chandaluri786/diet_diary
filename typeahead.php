<?php
session_start();
require_once 'connection.php';
if($_GET['activity'] == 'Breakfast'||$_GET['activity'] == 'Snacks'||$_GET['activity'] == 'Lunch'||$_GET['activity'] == 'Dinner'){
$stmt = $conn->prepare('select item_name from food_chart where item_name like :prefix');
$stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));
$retval = array();
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
  $retval[] = $row['item_name'];
}
}
if($_GET['activity'] == 'Exercise'){
    $stmt = $conn->prepare('select exercise_name from exercise where exercise_name like :prefix');
    $stmt->execute(array( ':prefix' => $_REQUEST['term']."%"));
    $retval = array();
    while ( $row = $stmt->fetch(PDO::FETCH_ASSOC) ) {
      $retval[] = $row['exercise_name'];
    }
    }
echo(json_encode($retval, JSON_PRETTY_PRINT));

?>