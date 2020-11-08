<?php
require_once 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<title> Sign Up</title>
<style>
  @import url(https://fonts.googleapis.com/css?family=Roboto:400,300,500);
*:focus {
  outline: none;
}

body {
  margin: 0;
  padding: 0;
  background:url("https://visme.co/blog/wp-content/uploads/2017/07/50-Beautiful-and-Minimalist-Presentation-Backgrounds-036.jpg")no-repeat;
   background-size:cover;
  font-size: 16px;
  color: #222;
  font-family: 'Roboto', sans-serif;
  font-weight: 300;
}

#login-box {
  position: relative;
  margin: 5% auto;
  width: 400px;
  height: 800px;
  background: white;
  border-radius: 5px;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.9);
}

.left {
  position: absolute;
  top: 0;
  left: 0;
  box-sizing: border-box;
  padding: 40px;
  width: 300px;
  height: 400px;
}

h1 {
  margin: 0 0 20px 0;
  font-weight: 600;
  font-size: 30px;
  font-family: cursive;
}

input[type="text"],
input[type="password"] {
  display: block;
  box-sizing: border-box;
  margin-bottom: 20px;
  padding: 4px;
  width: 220px;
  height: 35px;
  border: none;
  border-bottom: 1px solid #AAA;
  font-family: 'Roboto', sans-serif;
  font-weight: 400;
  font-size: 15px;
  transition: 0.2s ease;
}

input[type="text"]:focus,
input[type="password"]:focus {
  border-bottom: 2px solid #16a085;
  color: #16a085;
  transition: 0.2s ease;
}

input[type="submit"] {
  margin-top: 30px;
  width: 120px;
  height: 35px;
  background:  purple;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  text-transform: uppercase;
  transition: 0.1s ease;
  cursor: pointer;
}

input[type="submit"]:hover,
input[type="submit"]:focus {
  opacity: 0.8;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.1s ease;
}

input[type="submit"]:active {
  opacity: 0.6;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.6);
  transition: 0.1s ease;
  
}
.button {
  padding: 15px 25px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: black;
  color:FFF;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px #999;
}
.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #CC99FF;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
}



.right {
  position: absolute;
  top: 0;
  right: 0;
  box-sizing: border-box;
  padding: 40px;
  width: 300px;
  height: 400px;
  background-size: cover;
  background-position: center;
  border-radius: 0 4px 4px 0;
}

.right .loginwith {
  display: block;
  margin-bottom: 40px;
  font-size: 28px;
  color: #FFF;
  text-align: center;
}

button.social-signin {
  margin-bottom: 20px;
  width: 220px;
  height: 36px;
  border: none;
  border-radius: 2px;
  color: #FFF;
  font-family: 'Roboto', sans-serif;
  font-weight: 500;
  transition: 0.2s ease;
  cursor: pointer;
  background-color:blue;
}

button.social-signin:hover,
button.social-signin:focus {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;
}

button.social-signin:active {
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.4);
  transition: 0.2s ease;

}

</style>
</head>
<body>
<div id="login-box">
  <div class="left">
    <h1>Sign Up</h1>
    <form name = "f1" id="f1" action="signup.php" method="post">
    <input type="text" name="uname" placeholder="User Name"/>
    <input type="text" name="fname" placeholder="First Name"/>
    <input type="text" name="lname" placeholder="Last Name"/>
     <p>Please select your gender:</p>
  <input type="radio" id="male" name="gender" value="male">
  <label for="male">Male</label>
  <input type="radio" id="female" name="gender" value="female">
  <label for="female">Female</label><br><br> 
   <p> D.O.B:<input type="date" name="dob" placeholder="Date Of Birth"/></P>
   <input type="text" name="height" placeholder="Height"/>
   <input type="text" name="weight" placeholder="Weight"/>
    <input type="text" name="health" placeholder="Health History"/>
     <input type="ext" name="ph_no" placeholder="Phone no" />
    <input type="text" name="email" placeholder="E-mail" />
    
    
 
    <input type="password" name="password" placeholder="Password" />
    <input type="password" name="password2" placeholder="Retype password" />
    
   <input type="submit" name="submit" onclick="return validateForm()" value="Sign me up" />
</form>
  
  </div>
  
  <?php
  if(isset($_POST['submit'])){
  $uname=$_POST['uname'];
    $ph_no = $_POST['ph_no'];
    $gender = $_POST['gender'];
    $sname = $_POST['lname'];
    $weight=$_POST['weight'];
    $height=$_POST['height'];
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $health_history = $_POST['health'];
    $dob = $_POST['dob'];
    $password = $_POST['password'];
    $repassword = $_POST['password2'];

    $stmt = $conn->prepare('select * from users where user_name=:u');
    $stmt->execute(array('u'=>$uname));
    $res = $stmt->fetchall(PDO::FETCH_OBJ);
    //print_r($res);
    if($res != NULL){
        echo '<script>alert("Please give another user name. Thisd one is already taken")</script>';
    }
    else if($password==$repassword ){
        $stmt = $conn->prepare('insert into users (user_name,password,category) values (:un,:p,:c)');
        $stmt->execute(array('un'=>$uname, 'p'=>$password,'c'=>'user'));
        //$stmt->debugDumpParams();
        $stmt = $conn->prepare('insert into profile (first_name,last_name,dob,height,weight,emil,ph_no,health_history,gender, user_id) values (:f,:l,:d,:h,:w,:e ,:p ,:hh,:g,:id)');
        $stmt->execute(array('f'=>$fname,'l' => $lname,'d'=>$dob,'h'=> $height,'w'=> $weight,'e'=>$email ,'p'=>$ph_no ,'hh'=>$health_history,'g'=>$gender,'id' => $_SESSION['user_id']));
        //$stmt->debugDumpParams();
        header("Location: login.php");
      
  }else{
    echo '<script>alert("INVALID DEATILS")</script>'; 
  }
}
?>
    

</div>
<script>
function validateForm(){
   console.log("entered");
    var e = document.forms["f1"]["email"].value;
    var fn = document.forms["f1"]["fname"].value;
    var ln = document.forms["f1"]["lname"].value;
    var d = document.forms["f1"]["dob"].value;
    var h = document.forms["f1"]["height"].value;
    var w= document.forms["f1"]["weight"].value;
    var p = document.forms["f1"]["ph_no"].value;
    var u = document.forms["f1"]["uname"].value;
    var pwd = document.forms["f1"]["password"].value;
    var pwd1 = document.forms["f1"]["password2"].value;
  
  if(!(validateEmptyField(e)&&validateEmptyField(fn)&&validateEmptyField(ln)&&validateEmptyField(p)&&validateEmptyField(h)&&validateEmptyField(w)&&validateEmptyField(pwd)&&validateEmptyField(pwd1)&&validateEmptyField(u))){
      alert('All fields are required');
      return false;
  }
  
    return validatePassword(pwd,pwd1)&&validateEmptyField(e)&&validateEmptyField(fn)&&validateEmptyField(ln)&&validateEmptyField(p)&&validateEmptyField(h)&&validateEmptyField(w)&&validateEmptyField(pwd)&&validateEmptyField(pwd1)&&validateEmptyField(u)&&validateEmail(e) ;
}
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!re.test(email)){
     alert('Incorrect email id');
     return false;
  }
  return re.test(email);
}
function validatePassword(pass1,pass2)
{
  if(!(pass1==pass2))
  {
    alert("Re entered Password does not match!!");
    return false;
  }
  return true;
}
function validateEmptyField(x){
    
  if (x == "") {
  
    return false;
  }
  return true;
}
</script>
</body>
</html>