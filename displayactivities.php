<?php
function displayActivities($date)
{
    //retrieving diaryid
$stmt = $conn->prepare('select diary_id from my_diary where user_id = :uid and date = :d');
$stmt->execute(array(':uid' => $_SESSION['user_id'], ':d' => $date));
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
                    <span class="start">' . $d->start_time . '</span>
                </div>
                <div class="item">'.$d->item_name.'</div>
                <div class="calories"><i>'.$d->calories.'cal</i></div>
            </td>
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
                    <span class="start">' . $d->start_time . '</span>-<span class="end">' . $d->end_time . '</span>
                </div>
                <div class="item">'.$d->exercise_name.'</div>
                <div class="calories"><i>'.$d->calories_burnt.'cal</i></div>
            </td>
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
                    <span class="start">' . $r->start_time . '</span>-<span class="end">' . $r->end_time . '</span>
                </div>
            </td>
        </tr>
    </table>
</div>';
    }
}
}
?>