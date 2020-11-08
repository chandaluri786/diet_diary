<?php
session_start();
require_once 'connection.php';
include_once 'header.php';
// enable jquery for forrm and make changes accordingly
//select my_diary.date, sum(food_chart.calories) from my_diary_activity natural join my_diary  join food_chart using (item_id) where my_diary.user_id=3 group by my_diary.date ;

?>

<body>
<?php
include_once 'sideNavigation.php';
include_once 'topNavigation.php';
?>

<?php
//$_SESSION['user_id'] = 3;
if (isset($_POST['login'])) {
    $username = htmlentities($_POST['email']);
    $password = htmlentities($_POST['pass']);
 //  echo $password;

    $user = $conn->prepare('select * from users where user_name = :username and password = :password');
    $user->bindValue(':username', $username, PDO::PARAM_STR);
    $user->bindValue(':password', $password, PDO::PARAM_STR);
    $user->execute();
    $res = $user->fetch(PDO::FETCH_OBJ);
    if ($res != null) {
        $_SESSION['user_id'] = $res->user_id;
        $_SESSION['user_name'] = $res->user_name;

    } else {
        $_SESSION['error'] = "Incorrect Password";
        header("Location: login1.php");
    }
}
?>

    <?php
     $stmt = $conn->prepare('select my_diary.date, sum(food_chart.calories) as cal from my_diary_activity natural join my_diary  join food_chart using (item_id) where my_diary.user_id = :uid group by my_diary.date ');
     $stmt -> execute(array(':uid' => $_SESSION['user_id']));
     $res = $stmt -> fetchall(PDO::FETCH_OBJ);
     /*$dataPoints_1 = array(
         array("y" => 25, "label" => "Sunday"),
         array("y" => 15, "label" => "Monday"),
         array("y" => 25, "label" => "Tuesday"),
         array("y" => 5, "label" => "Wednesday"),
         array("y" => 10, "label" => "Thursday"),
         array("y" => 0, "label" => "Friday"),
         array("y" => 20, "label" => "Saturday")
     );*/
     $dataPoints_1a = array();
     foreach($res as $r){
         array_push($dataPoints_1a,array("y" => $r->cal, "label" => $r->date));
     }
      $stmt = $conn -> prepare('select my_diary.date,sum(timediff (my_diary_activity.end_time , my_diary_activity.start_time)/:n * exercise.calories_burnt) as calburnt from my_diary_activity natural join my_diary  join exercise
      using (exercise_id) where my_diary.user_id=:uid group by my_diary.date ');
      $stmt -> execute(array(':n'=>1500,':uid' => $_SESSION['user_id']));
      $res = $stmt -> fetchall(PDO::FETCH_OBJ);
      $dataPoints_1b = array();
     foreach($res as $r){
         array_push($dataPoints_1b,array("y" => $r->calburnt, "label" => $r->date));
     }
     //hours of sleep
     $stmt = $conn -> prepare('select my_diary.date,sum(timediff (my_diary_activity.end_time , my_diary_activity.start_time)/:n ) as sleep from my_diary_activity natural join my_diary  where my_diary.user_id=:uid and  my_diary_activity.activity = :a group by  my_diary.date ');
     $stmt -> execute(array(':n'=>10000,':uid' => $_SESSION['user_id'],':a'=>'sleep'));
     $res = $stmt -> fetchall(PDO::FETCH_OBJ);
     //print_r($res);
     $dataPoints = array();
     foreach($res as $r){
     array_push($dataPoints,array("label"=>$r->date, "y"=> $r->sleep));
     }
     // hours of exercise
     $stmt = $conn -> prepare('select my_diary.date,sum(timediff (my_diary_activity.end_time , my_diary_activity.start_time)/:n ) as hrs from my_diary_activity natural join my_diary  join exercise
     using (exercise_id) where my_diary.user_id=:uid group by my_diary.date ');
     $stmt -> execute(array(':n'=>10000,':uid' => $_SESSION['user_id']));
     $res = $stmt -> fetchall(PDO::FETCH_OBJ);
     //print_r($res);
     $dataPointsE = array();
     foreach($res as $r){
     array_push($dataPointsE,array("label"=>$r->date, "y"=> $r->hrs));
     }
     ?>



<h1 class="main">welcome <?php echo $_SESSION['user_name']?></h1>
  
    <table >
      
        <tr>
            <td> 
                <div class="main" id="chartContainer_1" style="height: 250px; width: 90%;"></div>
    </td>

    <td> 
                <div class="main" id="chartContainer_2" style="height: 250px; width: 90%;"></div>
    </td>
    <td> 
                <div class="main" id="chartContainer_3" style="height: 250px; width: 90%;"></div>
    </td>
    </tr>
    </table>

   
     

<?php
include_once 'scripts.php';
?>
<script>
     window.onload = function () {

      
     var chart1 = new CanvasJS.Chart("chartContainer_1", {
         title: {
             text: "Calories intake trend"
         },
         axisY: {
             title: "calories"
         },
         
         data: [{
             type: "line",
             name: "Calories Intake",
             showInLegend: true,
             dataPoints: <?php echo json_encode($dataPoints_1a, JSON_NUMERIC_CHECK); ?>
         },{
             type: "line",
             name: "Calories Burnt",
             showInLegend: true,
             dataPoints: <?php echo json_encode($dataPoints_1b, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart1.render();
     //*****
     
     var chart2 = new CanvasJS.Chart("chartContainer_2", {
         title: {
             text: "Hours of sleep"
         },
         axisY: {
             title: "hours"
         },
         
         data: [{
             type: "line",
             name: "Hours of sleep",
             showInLegend: true,
             dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart2.render();

     //*******************
     var chart3 = new CanvasJS.Chart("chartContainer_3", {
         title: {
             text: "Hours of Exercise"
         },
         axisY: {
             title: "hours"
         },
         
         data: [{
             type: "line",
             name: "Hours of Exercise",
             showInLegend: true,
             dataPoints: <?php echo json_encode($dataPointsE, JSON_NUMERIC_CHECK); ?>
         }]
     });
     chart3.render();

     
     }
     </script>
     </body>
     </html>                              