<?php
session_start();
if(isset( $_SESSION['error']))
{
?>
<script>
   alert('<?php echo $_SESSION['error']; ?>') ;
</script>
    <?php
}

?>
<head>
<style>
   body {
        background:url("https://i.pinimg.com/originals/a8/cf/d1/a8cfd15e1634174251a7db414cd898ad.png")no-repeat;
        background-size:cover;
        font-family: 'Ubuntu', sans-serif;
    }
    
    .main {
        background-color: #FFFFFF;
        width: 450px;
        height: 450px;
        margin: 7em auto;
        border-radius: 1.5em;
        box-shadow: 0px 11px 35px 2px rgba(0, 0, 0, 0.14);
    }
    
    .sign {
        padding-top: 40px;
        color: #8C55AA;
        font-family: 'Ubuntu', sans-serif;
        font-weight: bold;
        font-size: 23px;
    }
    
    .un {
    width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
    form.form1 {
        padding-top: 40px;
    }
    
    .pass {
            width: 76%;
    color: rgb(38, 50, 56);
    font-weight: 700;
    font-size: 14px;
    letter-spacing: 1px;
    background: rgba(136, 126, 126, 0.04);
    padding: 10px 20px;
    border: none;
    border-radius: 20px;
    outline: none;
    box-sizing: border-box;
    border: 2px solid rgba(0, 0, 0, 0.02);
    margin-bottom: 50px;
    margin-left: 46px;
    text-align: center;
    margin-bottom: 27px;
    font-family: 'Ubuntu', sans-serif;
    }
    
   
    .un:focus, .pass:focus {
        border: 2px solid rgba(0, 0, 0, 0.18) !important;
        
    }
    
    .submit {
      cursor: pointer;
        border-radius: 5em;
        color: #fff;
        background: linear-gradient(to right, #9C27B0, #E040FB);
        border: 0;
        padding-left: 40px;
        padding-right: 40px;
        padding-bottom: 10px;
        padding-top: 10px;
        font-family: 'Ubuntu', sans-serif;
        margin-left: 35%;
        font-size: 13px;
        box-shadow: 0 0 20px 1px rgba(0, 0, 0, 0.04);
    }
    
    .forgot {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        padding-top: 15px;
    }
    
    input[type=submit] {
        text-shadow: 0px 0px 3px rgba(117, 117, 117, 0.12);
        color: #E1BEE7;
        text-decoration: none
    }
    
    @media (max-width: 600px) {
        .main {
            border-radius: 0px;
        }

        

</style>
</head>
<body >
<?php
//include_once('sideNavigation.php');
//include_once('topNavigation.php');
?>
<?php
require_once 'connection.php';
?>
<?php
  if(isset($_POST['submit'])){
  $uname=$_POST['uname'];
    $ph_no = $_POST['ph_no'];
    $gender = $_POST['gender'];
    $lname = $_POST['lname'];
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
        echo '<script>alert("Please give another user name. This one is already taken.Please Reregister Again!")</script>';
       

    }
    else if($password==$repassword ){
      try{
       // $conn->beginTranscation();
        $stmt0 = $conn->prepare('insert into users (user_name,password,category) values (:un,:p,:c)');
        $stmt0->execute(array('un'=>$uname, 'p'=>$password,'c'=>'user'));
        //$conn->commit();
        //$stmt0->debugDumpParams();
       // echo "******" ;
        $lastInsertId = $conn->lastInsertId();
        //echo $lastInsertId;
        $stmt = $conn->prepare('insert into profile (first_name,last_name,dob,height,weight,email,ph_no,health_history,gender, user_id) values (:f,:l,:d,:h,:w,:e ,:p ,:hh,:g,:id)');
        $stmt->execute(array('f'=>$fname,'l' => $lname,'d'=>$dob,'h'=> $height,'w'=> $weight,'e'=>$email ,'p'=>$ph_no ,'hh'=>$health_history,'g'=>$gender,'id' => $lastInsertId ));
        //$stmt->debugDumpParams();
       // header("Location: login1.php");
       echo '<script>alert(" Registration Successful...!")</script>';
       
      
      }
      catch(PDOExeception $ex){
        echo '<script>alert(" Registration Not Successful...!")</script>';
//echo $ex;
      }
        
  }else{
    echo '<script>alert("INVALID DEATILS")</script>'; 
  }
}

?>
<div class="main">
<p class="sign" align="center">Sign in</p>
<form id="f1" class="form1" action="dashboard.php" method="POST" onsubmit="return validateForm()">

<input class="un " type="textbox" id="email" name="email" placeholder="Username">
<br>

<input class="pass" type="password" id="pass" name="pass" placeholder="Password" >
<br>
<input class="submit" type = "submit" name="login" lign="center" value ="Sign in"> 
</form>
</div>
<script>
function validateForm(){
    var x = document.forms["f1"]["email"].value;
    var y = document.forms["f1"]["pass"].value;
  
  if(!(validateEmptyField(x)&&validateEmptyField(y))){
      alert('All fields are required');
  }
  
    return  validateEmptyField(x)&&validateEmptyField(y) ;
}
function validateEmail(email) {
  var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if(!re.test(email)){
     alert('Incorrect email id');
  }
  return re.test(email);
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