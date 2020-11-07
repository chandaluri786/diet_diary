<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
require_once 'header.php';
$_SESSION['user_id']=3;
?>
<html>
<head>
<style>
.questions {
    position:relative;               
    bottom:0;                            
}
</style>
</head>
<?php
//inserting a query

if(isset($_POST['post'])){
$stmt = $conn->prepare('insert into questions (user_id,questions,timestamp) values(:uid,:q,:t)');
$stmt->execute(array(':uid' => $_SESSION['user_id'],':q' => $_POST['query'],'t'=>date('Y/m/d H:i:s')));
}
// adding reply 
  if(isset($_POST['reply'])){
    $stmt = $conn->prepare('insert into responses(user_id,responses,timestamp,q_id) values(:uid,:r,:t,:q)');
    $stmt->execute(array(':uid' => $_SESSION['user_id'],':r' => $_POST['ans'],':t'=>date('Y/m/d H:i:s'),':q'=> $_GET['q']));
    }
?>
<body>
<div class="main">
<div align="center"><h2>Question And Responses</h2>
<?php

//displaying previous questions and replies
$stmt1 = $conn->prepare('select * from questions,users where questions.user_id = users.user_id');
$stmt1->execute();
$res1 = $stmt1->fetchall(PDO::FETCH_OBJ);

foreach($res1 as $r1 )
{

echo '<div class="card" style="width: 50%;">
  <div class="card-body">
      <p class="text-muted" align="left"><span>'.$r1->user_name.'</span><span>'.$r1->timestamp.'</span></p>
      <p class="card-text" align="left">'.$r1->questions.'</p>';
     // echo '<p justify = "right" onclick="toggle()" style = "color:blue; text-decoration:underline; cursor:pointer;">Reply</p>';
      

 
  $stmt = $conn->prepare('select users.user_name as user_name,responses.responses as responses, responses.timestamp as timestamp from responses,users where  responses.q_id = :q and responses.user_id = users.user_id');
  $stmt->execute(array(':q'=>$r1->q_id));
  $res = $stmt->fetchall(PDO::FETCH_OBJ);
  foreach($res as $r){
  echo'<hr>
      <p class="text-muted" align="left" ><span>'.$r->user_name.'</span><span>'.$r->timestamp.'</span></p>
      <p class="card-text" align="left">'.$r->responses.'</p>';
  }
  echo '<form  class="card-link"  action="discussionforum.php?q='.$r1->q_id.'" method="POST" >
      <textarea name="ans" id ="ans" rows="1" cols="50%"></textarea>
      <input type="submit" name="reply" id="reply" value="Post">
      </form>';
  echo' </div>
  </div>';
        
  echo '<br>';
}


?>

<!--<div class="card" style="width: 50%;">
  <div class="card-body">
   <h5 class="card-title">Card title</h5>
    <p class="text-muted" align="left"><span>username</span><span>date and time<span></p>
    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
   <a href="#" class="card-link">Card link</a>
    <a href="#" class="card-link">Another link</a>
  </div>
  
</div>-->

<form   class= "questions" action="discussionforum.php" method="POST" >
<textarea name="query" id ="query" rows="2" cols="100%"></textarea>
<input type="submit" name="post" id="post" value="Post" >
</form>
</div>
<?php 
require_once 'scripts.php';
?>
</body>
</html>
