<?php
session_start();
require_once 'connection.php';
require_once 'header.php';
require_once 'topNavigation.php';
require_once 'sideNavigation.php';
require_once 'displayactivities.php';
?>
<html>

    <body>
    <div class = "main">
       <center>
        <form class="col-auto" action='pe1.php' method='POST' >
            <input type = 'date' style="width: 25%; text-align: center;" id = 'date' name = 'date' value = "<?php echo $_POST['date'];?>">
            <input type = 'submit' id = "view" name = "view"  value = "view" >
        </form>
        </center>
<table  style="width:100%">
    <tr>
        <td>    
<?php
//$_SESSION['user_id'] = 3;
 // display logic
//retrieving diaryid
$date = date("Y-m-d");
$stmt = $conn->prepare('select diary_id from my_diary where user_id = :uid and date = :d');
$stmt->execute(array(':uid' => $_SESSION['user_id'], ':d' => $date));
$diary_id = $stmt->fetch(PDO::FETCH_OBJ);

if (isset($_POST['view'])) {
    $date =  $_POST['date'];
    $stmt = $conn->prepare('select diary_id from my_diary where user_id = :uid and date = :d');
    $stmt->execute(array(':uid' => $_SESSION['user_id'], ':d' =>$date));
    $diary_id = $stmt->fetch(PDO::FETCH_OBJ);
}
 
//displaying the entry
$stmt = $conn->prepare('select * from my_diary_activity where diary_id = :did order by my_diary_activity.start_time asc');
$stmt->execute(array(':did' => $diary_id->diary_id));
$res = $stmt->fetchall(PDO::FETCH_OBJ);
foreach ($res as $r) {
    if ($r->item_id) {
        $stmt = $conn->prepare('select * from my_diary_activity natural join food_chart where my_diary_activity.diary_id = :did and my_diary_activity.item_id = :iid ');
        $stmt->execute(array(':did' => $diary_id->diary_id, ':iid' => $r->item_id));
        $d = $stmt->fetch(PDO::FETCH_OBJ);
        //print_r($d);
        echo ' <div class="activity-container">

    <table class="activity">
        <tr>
            <td class="icon"><img src="'. strtolower($d->activity) . '.jpg" width="150" height="150" title="' . $d->activity . '"></td>
            <td class="description">
                <div class="slot"><i class="fas fa-clock-o" style="font-size:16px"></i>
                    <span class="start">' . date ('H:i',strtotime($d->start_time)) . '</span>
                </div>
                <div class="item">'.$d->item_name.'</div>
                <div class="calories"><i>'.$d->calories.'cal</i></div>
            </td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp</td>
        </tr>
    </table>
</div>';
    }
    if ($r->exercise_id) {
        $stmt = $conn->prepare('select * from my_diary_activity natural join exercise where my_diary_activity.diary_id = :did and my_diary_activity.exercise_id = :eid ');
        $stmt->execute(array(':did' => $diary_id->diary_id, ':eid' => $r->exercise_id));
        $d = $stmt->fetch(PDO::FETCH_OBJ);
        // print_r($d);
        echo ' <div class="activity-container">

    <table class="activity">
        <tr>
            <td class="icon"><img src="'. strtolower($d->activity) . '.jpg" width="150" height="150" title="' . $d->activity . '"></td>
            <td class="description">
                <div class="slot"><i class="fas fa-clock-o" style="font-size:16px"></i>
                    <span class="start">' . date ('H:i',strtotime($d->start_time)) . '</span>-<span class="end">' . date ('H:i',strtotime($d->end_time)) . '</span>
                </div>
                <div class="item">'.$d->exercise_name.'</div>
                <div class="calories"><i>'.$d->calories_burnt.'cal</i></div>
            </td>
            <td>&nbsp&nbsp</td>
        </tr>
    </table>
</div>';
    }
    if ($r->item_id == null and $r->exercise_id == null) {
        echo ' <div class="activity-container">

    <table class="activity">
        <tr>
            <td class="icon"><img src="'. strtolower($r->activity) . '.jpg" width="150" height="150" title="' . $r->activity . '"></td>
            <td class="description">
                <div class="slot"><i class="fas fa-clock-o" style="font-size:16px"></i>
                    <span class="start">' . date ('H:i',strtotime($r->start_time)) . '</span>-<span class="end">' . date ('H:i',strtotime($r->end_time)) . '</span>
                </div>
            </td>
            <td>&nbsp&nbsp</td>
        </tr>
    </table>
</div>';
    }
}
 ?>
 </td>
 <td>
     <table border=2 style="width:100%">
         <tr>
         <td>
 <div >
                        <table style="background-color:white;size:16px;width:100%">
                            <tr>
                                <td>Calories intake:</td>
                                <td>
                                    <?php
                                    $stmt = $conn->prepare('select my_diary.date, sum(food_chart.calories) as cal from my_diary_activity natural join my_diary  join food_chart using (item_id) where my_diary.user_id = :uid group by my_diary.date having my_diary.date = :d ');
                                    $stmt -> execute(array(':uid' => $_SESSION['user_id'],':d'=>$date));
                                    $res = $stmt->fetch(PDO::FETCH_OBJ);
                                    //print_r($res);
                                    echo $res->cal;
                                    ?> cal
                                </td>
                            </tr>
                            <tr>
                                <td>Calories Burned:</td>
                                <td>
                                    <?php
                                     $stmt = $conn -> prepare('select my_diary.date,sum(timediff (my_diary_activity.end_time , my_diary_activity.start_time)/:n * exercise.calories_burnt) as calburnt from my_diary_activity natural join my_diary  join exercise
                                     using (exercise_id) where my_diary.user_id=:uid group by my_diary.date having my_diary.date = :d');
                                     $stmt -> execute(array(':n'=>1500,':uid' => $_SESSION['user_id'],':d'=>$date));
                                     $res = $stmt -> fetch(PDO::FETCH_OBJ);
                                     echo $res->calburnt;
                                     ?> cal
                                </td>
                            </tr>
                            
                        </table>
                    </div>
</td>
</tr><tr><td>

                <div  id="chartContainer_2" style="height: 250px; width: 100%;"></div>
                </td>
    </tr>
    </td>
    </tr>
    </table>
    
<?php
$stmt = $conn -> prepare('select my_diary.date,sum(TIME_TO_SEC(timediff (my_diary_activity.end_time , my_diary_activity.start_time))/:n  ) as sleep from my_diary_activity natural join my_diary 
 where my_diary.user_id=:uid and my_diary_activity.activity=:a group by my_diary.date having my_diary.date = :d');
$stmt -> execute(array(':n'=>3600,':uid' => $_SESSION['user_id'],':a' => 'sleep',':d'=>$date));
$res = $stmt -> fetch(PDO::FETCH_OBJ);
$dataPoints = array();
//foreach($res as $r){
   array_push($dataPoints,array("label"=>"Sleep", "y"=>(100/24)*$res->sleep));
   $stmt = $conn -> prepare('select my_diary.date,sum(TIME_TO_SEC(timediff (my_diary_activity.end_time , my_diary_activity.start_time))/:n ) as hrs from my_diary_activity natural join my_diary  join exercise
     using (exercise_id) where my_diary_activity.activity=:a and my_diary.user_id=:uid group by my_diary.date having my_diary.date = :d ');
     $stmt -> execute(array(':n'=>3600,':uid' => $_SESSION['user_id'],':a' => 'exercise',':d'=>$date));
     $r = $stmt -> fetch(PDO::FETCH_OBJ);
     array_push($dataPoints,array("label"=>'Exercise', "y"=> (100/24)*$r->hrs));
     array_push($dataPoints,array("label"=>'other', "y"=> 100-(100/24)*($res->sleep+$r->hrs)));
//print_r($dataPoints);
     //}
 /*
 $dataPoints_2 = array( 
     array("label"=>"Oxygen", "symbol" => "O","y"=>46.6),
     array("label"=>"Silicon", "symbol" => "Si","y"=>27.7),
     array("label"=>"Aluminium", "symbol" => "Al","y"=>13.9),
     array("label"=>"Iron", "symbol" => "Fe","y"=>5),
     array("label"=>"Calcium", "symbol" => "Ca","y"=>3.6),
     array("label"=>"Sodium", "symbol" => "Na","y"=>2.6),
     array("label"=>"Magnesium", "symbol" => "Mg","y"=>2.1),
     array("label"=>"Others", "symbol" => "Others","y"=>1.5),
  
 )*/
  
 ?>
 <?php
          include_once 'scripts.php';
  ?>
 <script>
     window.onload = function () {
   var chart2 = new CanvasJS.Chart("chartContainer_2", {
	theme: "light2",
	animationEnabled: true,
	title: {
		text: "Time distribution "
	},
	data: [{
		type: "pie",
		indexLabel: "{symbol} - {y}",
		yValueFormatString: "#,##0.0\"%\"",
		showInLegend: true,
		legendText: "{label} : {y}",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart2.render();
      
     }
     </script>
</div>
    
 
    </body>
</html>