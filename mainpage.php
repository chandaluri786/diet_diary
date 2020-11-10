<?php
require_once 'connection.php';
?>
<html>
<head>
<title> Diet Diary</title>
<style>
  body {
  background:url("https://cdn5.vectorstock.com/i/1000x1000/74/89/abstract-gradient-background-with-pastel-color-vector-23487489.jpg")no-repeat;
  background-size:cover;
}
h1 {
  font-weight: 600;
  font-size:40px;
  color:green;
}
.square_btn{
    margin-right:16px;
    display: inline-block;
    padding: 0.5em;
    text-decoration: none;
    border-radius: 4px;
    color: #ffffff;
    float:right;
    background-image: -webkit-linear-gradient(#67ceff 0%, #67ceff 100%);
    background-image: linear-gradient(#6795fd 0%, #67ceff 100%);
    box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.29);
    border-bottom: solid 3px #5e7fca;
  }

.square_btn:active{
    -ms-transform: translateY(4px);
    -webkit-transform: translateY(4px);
    transform: translateY(4px);
    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.2);
    border-bottom: none;
}
p.pos_;right{
position: relative;
right:20px;
}
 
</style>
</head>
<body>
<p>  <h1><center> <i>DIET DIARY</i></center></h1></p>
<p style="float:right"><h3><a href="login1.php" class="square_btn">sign in</a></p>
<p><a href="signup.php" class="square_btn">sign up</a></h3></p><br>
  
  <h2><p style ="text-align:right; color:green;"><i>-Healthy diet better life :)</h2></i><p>
 

<h2><i><p><b> As you write in your Diet you will create  a record of what works best for you.If your program does not prove satisfactory, you will have your own record challenge to improve upon next time. You will be amazed to find how your diet diary
will help you. We believe that after recording the details of just one day, you will suddenly become more dedicated towords your objectives which develop new level of awareness in you.<br>
 <br>
  </b></h2></i>
<hr>
<h3><i>User Reviews</i></h3>

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

?>


  
</body>
</html>
