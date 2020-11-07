<?php

session_start();

require_once 'connection.php';                                                                                                                                                             $_SESSION['user_id'] = 4;
require_once 'sideNavigation.php';
//require_once 'topNavigation.php';

//entering the feedback to the database

$_SESSION['user_id']=3;

if (isset($_POST['submit'])) {
    $stmt = $conn->prepare('insert into feedback (description,rating,user_id,country) values (:d, :r, :uid,:c)');

    $stmt->execute(array(':d' => $_POST['desc'], ':r' =>$_POST['rating'],':uid' => $_SESSION['user_id'], ':c' => $_POST['country'] ));
}

?>

 

<html>

<head>

<meta name="viewport" content="width=device-width, initial-scale=1">

 

<meta charset='UTF-8'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="sideNavigation.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<!--<link rel='stylesheet' href='css/style.css'>-->

<style>
/*
body {

  background-image: url('back1.jpg');

  background-repeat: no-repeat;

  background-attachment: fixed; 

  background-size: cover;

}*/

 

* {   

  box-sizing: border-box;   

}  



    input[type=text], select, textarea {   

  width: 100%;   

  padding: 12px;   

  border: 1px solid rgb(70, 68, 68);   

  border-radius: 10px;   

  resize: vertical;

   

}   

 

label {   

  padding: 12px 20px 12px 0;   

  display: inline-block;   

}   

   



input[type=submit] {   

  background-color: rgb(37, 116, 161);   

  color: white;   

  padding: 20px 40px;   

  border: none;   

  border-radius: 25px;   

  cursor: pointer;   

  float: right;   

}   

   

input[type=submit]:hover {   

  background-color: #bfbfbf;

}   

    

.container { 
  border-radius: 20px;   
  background-color: #ccd9ff;
  padding:35px;   
 
}   

   

.col-25 {   

  float: left;   

  width: 25%;   

  margin-top: 6px;   

}   

  

.col-75 {   

 float: left;   

  width: 75%;   

  margin-top: 6px;   

}   
 
   

/* Clear floats after the columns */   

.row:after {   

  content: "";   

  display: table;   

  clear: both;   

}   

</style>

</head>   

<body>

<div class = "main">

  

<h1><p style="color:#0066cc" >Feedback Form</h1></p>

<div class="container">   

  <form action='feedback.php' method="POST">   

  <div class="row"> 
</div>

   <div class="row">   

      <div class="col-25">   

        <label for="country"><b>Country<b></label>   

      </div>   

 

      <div class="col-75">   

        <select   name="country">   

            <option value="none">Select Country</option>   

          <option value="australia">Australia</option>   

          <option value="canada">Canada</option>   

          <option value="usa">USA</option>   

          <option value="russia">Russia</option>   

          <option value="japan">Japan</option>   

          <option value="india">India</option>   

          <option value="china">China</option>   

        </select>   

      </div>    

    </div>  

 

    <div class="row">   

      <div class="col-25">   

        <label for="feed_back">Feed Back</label>   

      </div>   

      <div class="col-75">   

        <textarea id="desc" name="desc" placeholder="Write something.." style="height:200px"></textarea>   

      </div>   

    </div>   

 

<div class="row">   

      <div class="col-25">   

        <label for="rating">Please rate us:</label>   

      </div>   

      <div class="col-75">

<textarea id="rating" name="rating" placeholder="out of 5..." style="height:45px "></textarea>   

      </div>   

    </div> 

 

 

 

<br>

    <div class="row">   

      <input type="submit" name="submit" id="submit" value="Submit">   

    </div>   

  </form>   

</div> 
</div>
<?php
require_once 'scripts.php';
?>
 

</body>   

</html>