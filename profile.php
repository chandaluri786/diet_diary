<?php
session_start();
//use get to get profile id
require_once 'connection.php';
//require_once 'header.php';
require_once 'topNavigation.php';
require_once 'sideNavigation.php';
//$_SESSION['user_id']=3;
?>
<html>
    <head>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
      <link rel="stylesheet" href="sideNavigation.css">
      <link rel="stylesheet" href="feedback.css">
      <script src='https://kit.fontawesome.com/a076d05399.js'></script>
      
       </head> 
<body>
<?php
if(isset($_POST['update'])){

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$dob = $_POST['dob'];
$gender = $_POST['gen'];
$h = $_POST['height'];
$w = $_POST['weight'];
$health = $_POST['health'];
$e = $_POST['email'];
$ph = $_POST['phone'];
$disp = $conn->prepare('update profile set first_name = :f , last_name = :l , dob = :d , height = :h , weight = :w , email = :e, ph_no = :p , health_history = :hh , gender = :g where user_id = :id');
$disp->execute(['f'=>$fname,'l' => $lname,'d'=>$dob,'h'=> $h,'w'=> $w,'e'=>$e ,'p'=>$ph ,'hh'=>$health,'g'=>$gender,'id' => $_SESSION['user_id']]);
//$disp->debugDumpParams();
echo '<script>alert("Your request has been processed.Changes made successfully.");</script>';
}
?>
<div class="main">
<h1>&nbsp</h1>
<h1><p style="color:#0066cc;font-weight:bold" >Profile</p></h1>
<h1>&nbsp</h1>
<?php
$disp = $conn->prepare('select * from users inner join profile on users.user_id = profile.user_id  where users.user_id = :uid');
$disp->execute(array(':uid' => $_SESSION['user_id']));
$res = $disp->fetch(PDO::FETCH_OBJ);
//$disp->debugDumpParams();
//print_r($res);
echo '<div class="container"><form  action = "profile.php" method = "POST"> <div class="row"> 
</div>

   <div class="row">   

      <div class="col-25"> 
<label  >FirstName</label></div> <div class="col-75"><input   type = "text" name = "fname" value = "'.$res->first_name.'"></div>    

</div> 
<div class="row">   

      <div class="col-25"> 
<label>LastName</label></div>   

<div class="col-75"> <input   type = "text" name = "lname" value = "'.$res->last_name.'"></div>   

</div>  
<div class="row">   

      <div class="col-25"> 
<label>Date of birth</label></div>   

<div class="col-75"> <input   type = "text" name = "dob" value = "'.$res->dob.'"></div>   

</div> 
<div class="row">   

      <div class="col-25">
<label>Gender</label></div>   

<div class="col-75"> <input   type = "text" name = "gen" value = "'.$res->gender.'"></div>   

</div> 
<div class="row">   

      <div class="col-25">
<label>Height</label></div>   

<div class="col-75"> <input   type = "text" name = "height" value = "'.$res->height.'"></div>   

</div> 
<div class="row">   

      <div class="col-25">
<label>Weight</label></div>   

<div class="col-75"> <input   type = "text" name = "weight" value = "'.$res->weight.'"></div>   

</div> 
<div class="row">   

      <div class="col-25">
<label>Health History</label></div>   

<div class="col-75"> <input   type = "text" name = "health" value = "'.$res->health_history.'"></div>   

</div> 
<div class="row">   

      <div class="col-25">
<label>Email</label></div>   

<div class="col-75"> <input   type = "text" name = "email" value = "'.$res->email.'"></div>   

</div> 
<div class="row">   

      <div class="col-25">
<label>Phno</label></div>   

<div class="col-75"> <input   type = "text" name = "phone" value = "'.$res->ph_no.'"></div>   

</div> 
<div class="row">   

      <input type="submit"  name="update" id="update" value = "Update">   

    </div>  

</form>
</div>';
?>

</div>
<?php
require_once 'scripts.php';
?>
</body>
</html>
