<?php
session_start();
require_once 'connection.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
require_once 'header.php';
//$_SESSION["user_id"] = 3;
//$conn = mysqli_connect("localhost", "root", "test", "blog_samples") or die("Connection Error: " . mysqli_error($conn));

if (isset($_POST['submit'])) {
    $result = $conn->prepare('select * from users where user_id =:uid and password=:p');
    $result->execute(array('uid'=> $_SESSION["user_id"],'p'=>$_POST["currentPassword"]));
    $row = $result->fetch(PDO::FETCH_OBJ);
    print_r($row);
    if ($_POST["currentPassword"] == $row->password && $row != NULL) {
        $result = $conn->prepare('update users set password=:np where user_id=:uid');
        $result->execute(array('np'=>$_POST["newPassword"] ,'uid'=> $_SESSION["user_id"]));
       // $result->debugDumpParams();
        $message = "Password Changed";
    } else {
        $message = "Current Password is not correct";
    }
}
?>
<style>/*body{
	background-image:url("bg2.jpeg");
	background-repeat:no repeat;
	backgroung-attachment:fixed;
	background-size:cover;
	font-family:Arial;}*/
input {
font-family:Arial;
font-size:14px;
}
label{
font-family:Arial;
font-size:14px;
color:#999999;
}
.tblSaveForm {
border-top:2px #999999 solid;
background-color: #f8f8f8;
box-shadow: 2px 2px 20px 5px skyblue;

}
.tableheader {
background-color: blue;
}
.btnSubmit {
background-color: blue;
padding:5px;
border-color: black;
border-radius:4px;
color:white;
}
.message {
color: #FF0000;
text-align: center;
width: 100%;
}
.txtField {
padding: 5px;
border:#fedc4d 1px solid;
border-radius:4px;
}
.required {
color: #FF0000;
font-size:11px;
font-weight:italic;
padding-left:10px;
}</style>
<html>

<body>
<div class="main">
<h1>&nbsp</h1>
<h1>&nbsp</h1>
<h1>&nbsp</h1>
<h1>&nbsp</h1>

<div>
<form name="frmChange"class="main"  method="post" action="" onSubmit="return validatePassword()">
<div style="width:400px;">
<div class="message"><?php if(isset($message)) { echo $message; } ?></div>
<table border="0" cellpadding="10" cellspacing="0" width="500" align="center" class="tblSaveForm">
<tr class="tableheader">
<td colspan="2" style="color:white">Change Password</td>
</tr>
<tr>
<td width="40%"><label>Current Password</label></td>
<td width="60%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
</tr>
<tr>
<td><label>New Password</label></td>
<td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
</tr>
<td><label>Confirm Password</label></td>
<td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
</tr>
<tr>
<td colspan="2"><input type="submit" name="submit" value="Submit" class="btnSubmit"></td>
</tr>
</table>
</div>
</form>

<?php
require_once 'scripts.php';
?>
</div>
</div>
</body></html>

<script>
function validatePassword() {
var currentPassword,newPassword,confirmPassword,output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "required";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "required";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "required";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "not same";
output = false;
} 	
return output;
}
</script>
