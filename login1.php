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