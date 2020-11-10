<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
require_once 'header.php';
?>

<html>
<head>

 

<link rel="stylesheet" href="css.css">
<style>
    body {
  background-image: url('back1.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}

 

 

h1 {
  color: #0066cc;
  margin-left: 650px;
margin-top: 10px;
} 

 


.box {
  border-radius: 20px;
  background-color: #ccd9ff;
  width: 500px;
  border: 10px solid  #00aaff;
  padding: 50px;
  margin: 30px;
  margin-top: 5px;
  margin-left: 450px;
   
}
    </style>
 

</head>
<body>
    <div class = "main">
<h1>All Reviews</h1>

 <?php
 $stmt = $conn->prepare('select * from feedback,users where feedback.user_id=users.user_id order by feedback.f_id desc');
$stmt->execute();
$res = $stmt->fetchall(PDO::FETCH_OBJ);
foreach ($res as $r)
{
   

    echo '<div class="box">
<font color="#0066cc"><b>User Name:&nbsp&nbsp</font>'.$r->user_name.' <br>
<font color="#0066cc">Country:&nbsp&nbsp</font> '.$r->country.'<br>
<font color="#0066cc">Rating:&nbsp&nbsp</font>'.$r->rating.' <br>
<font color="#0066cc">Descrption:&nbsp&nbsp</font>'.$r->description.' <br>
 </font> </div>';
    }
require_once 'scripts.php';
?>


</div>


 


</body>
</html>