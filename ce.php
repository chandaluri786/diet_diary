<?php
session_start();
require_once 'connection.php';
include_once 'header.php';
// enable jquery for form and make changes accordingly
?>
<html>

    <head>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css"> 

<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
</head>
<body>

<?php
include_once 'sideNavigation.php';
include_once 'topNavigation.php';
?>
<?php
//$_SESSION['user_id'] = 3;



// Creating new entry
if (isset($_POST['Add'])) {

    //deciding intake or exercise
    $stmt = $conn->prepare('select item_id from food_chart where item_name = :n');
    $stmt->execute(array(':n' =>$_POST['item']));
    $item_id = $stmt->fetch(PDO::FETCH_OBJ);
    Print_r($item_id);

    $stmt = $conn->prepare('select exercise_id from exercise where exercise_name = :n');
    $stmt->execute(array(':n' => htmlentities($_POST['item'])));
    $exercise_id = $stmt->fetch(PDO::FETCH_OBJ);
    //Print_r($exercise_id);

    //server side check
    if($_POST['start'] == '')
    {
        echo '<script> alert("Please enter the start time"); </script>';  
    } 
    else if(($_POST['activity'] == 'Exercise'|| $_POST['activity'] == 'Sleep')&& $_POST['end'] == '')
    {
        echo '<script> alert("Please enter the end time"); </script>';  
    }
    else if(($_POST['activity'] == 'Breakfast' || $_POST['activity'] == 'Lunch' || $_POST['activity'] == 'Snacks' || $_POST['activity'] == 'Dinner'||$_POST['activity'] == 'Exercise') && $_POST['item'] == '')
    {
        echo '<script> alert("Please enter the item"); </script>'; 
    }
    else if((($_POST['activity'] == 'Breakfast' || $_POST['activity'] == 'Lunch' || $_POST['activity'] == 'Snacks' || $_POST['activity'] == 'Dinner') && ($item_id == NULL)) || ($_POST['activity'] == 'Exercise' && $exercise_id == NULL))
    {
            echo '<script> alert("This item is not available! Please Place a request for the item to be added."); </script>';      
    }
    
  else{

    //checking if the new entry of the day is already created by the user
      $stmt = $conn->prepare('select diary_id from my_diary where user_id = :uid and date = :d');
      $stmt->execute(array(':uid' => $_SESSION['user_id'], ':d' => date("Y-m-d")));
      $diary_id = $stmt->fetch(PDO::FETCH_OBJ);
    
      if ($diary_id == null) {
          //creating a new diary entry by providing the current date
          $stmt = $conn->prepare('insert into my_diary (date,user_id) values(:d,:uid)');
          $stmt->execute(array(':d' => date("Y-m-d"),':uid' => $_SESSION['user_id']));
          // $stmt->debugDumpParams();

          //finding the diary_id for the current diary entry
          $stmt = $conn->prepare('select diary_id from my_diary where user_id = :uid and date = :d');
          $stmt->execute(array(':uid' => $_SESSION['user_id'], ':d' => date("Y-m-d")));
          $diary_id = $stmt->fetch(PDO::FETCH_OBJ);
      }
    

      //entering the activity
    
      if ($_POST["end"] != null && $exercise_id) {
          $stmt = $conn->prepare('insert into my_diary_activity(diary_id,activity,start_time,end_time ,exercise_id) values (:did, :a, :s, :e, :eid)');
          $stmt->execute(array(':did' => $diary_id->diary_id,':a' => htmlentities($_POST['activity']),':s' => htmlentities($_POST['start']), ':e' => htmlentities($_POST['end']), ':eid' => $exercise_id->exercise_id));
      //$stmt->debugDumpParams();
      } elseif ($_POST["end"] != null && $item_id) {
          $stmt = $conn->prepare('insert into my_diary_activity(diary_id,activity,start_time,end_time,item_id) values (:did, :a, :s, :e, :iid)');
          $stmt->execute(array(':did' => $diary_id->diary_id,':a' => htmlentities($_POST['activity']),':s' => htmlentities($_POST['start']), ':e' => htmlentities($_POST['end']), ':iid' => $item_id->item_id));
      //$stmt->debugDumpParams();
      } elseif ($_POST["activity"] == "Sleep") {
          $stmt = $conn->prepare('insert into my_diary_activity(diary_id,activity, start_time, end_time) values (:did, :a, :s, :e)');
          $stmt->execute(array(':did' => $diary_id->diary_id,':a' => htmlentities($_POST['activity']),':s' => htmlentities($_POST['start']), ':e' => htmlentities($_POST['end'])));
      //$stmt->debugDumpParams();
      } else {
          $stmt = $conn->prepare('insert into my_diary_activity(diary_id,activity,start_time,item_id) values (:did, :a, :s, :iid)');
          $stmt->execute(array(':did' => $diary_id->diary_id,':a' => htmlentities($_POST['activity']),':s' => htmlentities($_POST['start']), ':iid' => $item_id->item_id));
         // $stmt->debugDumpParams();
      }
  }
}

?>
<?php

   /**
 *
 * Get times as option-list.
 *
 * @return string List of times
 */
function get_times ($default = '19:00', $interval = '+30 minutes') {

    $output = '';

    $current = strtotime('00:00');
    $end = strtotime('23:59');

    while ($current <= $end) {
        $time = date('H:i', $current);
        $sel = ($time == $default) ? ' selected' : '';

        $output .= "<option value=\"{$time}\"{$sel}>" . date('h.i A', $current) .'</option>';
        $current = strtotime($interval, $current);
    }

    return $output;
} 
?>

    <div class="main">

        <!-- <div align="center" style="font-weight: bold;">Diet diary</div> -->
        <div class="title-user"></div>
        <table class="actions">
            <tr>

                <td id="add" onclick = "toggle()"><i class="fas fa-edit" style="padding: 0 0 0 4%; " >Add</i></td>
            </tr>
        </table>
        <!--<div id="dialog-form" title="New Entry" class="modal">-->
            <form  class="form-all" id="f2" name = "f2" style=" display:none;" action="ce.php" method='POST'>
                <table>
                    <tr>
                        <td><label for="activity">Activity</label></td>
                        <td>
                            <select name="activity" id="activity" required>
                                <option  value="">Select activity</option>
                                <option  value="Breakfast">Breakfast</option>
                                <option  value="Lunch">Lunch</option>
                                <option  value="Snacks">Snacks</option>
                                <option  value="Dinner">Dinner</option>
                                <option  value="Exercise">Exercise</option>
                                <option  value="Sleep">Sleep</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <lable for="start" >Start Time</lable>
                        </td>
                 <!--      <td> <select name="start" id="start"><?php echo get_times(); ?></select></td>-->
                 <td><input id="start" type="time" name="start" ></input></td>
                    </tr>
                    <tr>
                        <td>
                            <lable for="end" >End Time</lable>
                        </td>
                        <td><input id="end" type="time" name="end" ></input></td>
                    </tr>
                    <tr>
                        <td>
                            <lable for="item" >Item</lable>
                        </td>
                        <td><input id="item" class ="item" type="text" name="item" value=''></input></td>
                    </tr>
                </table>
                <input type ="submit" id = "Add" name = "Add" value = "Add">
            </form>
       <!-- </div>-->
        <div class="date"><i>Date:</i><span><?php echo date("d-m-Y")?></span></div>
<?php

//retrieving diaryid
$stmt = $conn->prepare('select diary_id from my_diary where user_id = :uid and date = :d');
$stmt->execute(array(':uid' => $_SESSION['user_id'], ':d' => date("Y-m-d")));
$diary_id = $stmt->fetch(PDO::FETCH_OBJ);

//displaying the entry
$stmt = $conn->prepare('select * from my_diary_activity where diary_id = :did order by my_diary_activity.start_time asc');
$stmt->execute(array(':did' => $diary_id->diary_id));
$res = $stmt->fetchall(PDO::FETCH_OBJ);

foreach ($res as $r)
{
    if($r->item_id){
     
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
                    <span class="start">' .date ('H:i',strtotime($d->start_time)). '</span>
                </div>
                <div class="item">'.$d->item_name.'</div>
                <div class="calories"><i>'.$d->calories.'cal</i></div>
            </td>
            <td>&nbsp&nbsp&nbsp&nbsp&nbsp</td>
        </tr>
    </table>
</div>';
    }
    if($r->exercise_id){
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
                    <span class="start">' . date ('H:i',strtotime($d->start_time)) . '</span>-<span class="end">' .date ('H:i',strtotime($d->end_time)) . '</span>
                </div>
                <div class="item">'.$d->exercise_name.'</div>
                <div class="calories"><i>'.$d->calories_burnt.'cal</i></div>
            </td>
            <td>&nbsp&nbsp</td>
        </tr>
    </table>
</div>';

    }
    if($r->item_id == NULL and $r->exercise_id == NULL)
    {
    echo ' <div class="activity-container">

    <table class="activity">
        <tr>
            <td class="icon"><img src="'. strtolower($r->activity) . '.jpg" width="150" height="150" title="' . $r->activity . '"></td>
            <td class="description">
                <div class="slot"><i class="fas fa-clock-o" style="font-size:16px"></i>
                    <span class="start">' . date ('H:i',strtotime($r->start_time)). '</span>-<span class="end">' . date ('H:i',strtotime($r->end_time)) . '</span>
                </div>
            </td>
            <td>&nbsp&nbsp</td>
        </tr>
    </table>
</div>';
    }
}
?>

<?php
include_once 'scripts.php';
?>
<script>
    $(document).ready( 
        function(){
        var filter = 'Select activity';
        $("#activity").change(function () {
        var filter = this.value;
        console.log("typeahead.php?activity="+ filter +"&");
        $('.item').autocomplete({ source: "typeahead.php?activity="+ filter +"&" });
        
    });
    
    });
    </script>
</body>


</html>