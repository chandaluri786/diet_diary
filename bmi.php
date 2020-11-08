<?php
session_start();
//require_once 'header.php';
require_once 'sideNavigation.php';
require_once 'topNavigation.php';
?>
<html>
        <html>
           <head>
           <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="sideNavigation.css">
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    
            <style>
h3{
color:#00CCFF;
}
p{
	font-size:20px;
	color:#00CCFF;
}
.opt{
font-style:italic;
color:green;
}
	/*body{
	background-image:url("bg 2.jpeg");
	background-repeat:no repeat;
	backgroung-attachment:fixed;
	background-size:cover;
	}*/
 
    .t{ 
    margin-left:30% ;
   
          height: 400px;
          width: 600px;
	  padding:30px 30px 30px 50px; 
          background-color: white;
          display: inline-block;
          box-sizing: border-box;
          box-shadow: 2px 2px 20px 5px skyblue;

      }
    .c{
	font-family:Garamond;
	text-decoration:underline;
	color:blue;
	font-weight:bold;
    font-size:30px;
    vertical-align: text-top;
	}
    </style>
        
             
        <script type="text/javascript">
          
            function computeBMI() {
                // user inputs
                var height = Number(document.getElementById("height").value);
                var heightunits = document.getElementById("heightunits").value;
                var weight = Number(document.getElementById("weight").value);
                var weightunits = document.getElementById("weightunits").value;
        
        
                //Convert all units to metric
                if (heightunits == "inches") height /= 39.3700787;
                if (weightunits == "lb") weight /= 2.20462;
               //Perform calculation
        
                var BMI = weight /Math.pow(height, 2);
      
        
                //Display result of calculation
                document.getElementById("output").innerText = Math.round(BMI * 100) / 100;
        
                var output = Math.round(BMI * 100) / 100
                if (output < 18.5)
                    document.getElementById("comment").innerText ="Underweight";
                else if (output >= 18.5 && output <= 25)
                    document.getElementById("comment").innerText = "Normal";
                else if (output >= 25 && output <= 30)
                    document.getElementById("comment").innerText = "Obese";
                else if (output > 30)
                    document.getElementById("comment").innerText = "Overweight";
                // document.getElementById("answer").value = output; 
            }
        </script>
         </head>
         <body>
             <div class="main">
             <h1>&nbsp</h1>
             <h1 align="center" class="c">Body Mass Index Calculator</h1>
             <h1>&nbsp</h1>

         <table class="t">
        
        <tr><td><p>Enter your height: <input type="text" id="height"/>
            <select class = "opt" type="multiple" id="heightunits">
                <option value="metres" selected="selected">metres</option>
                <option value="inches">inches</option>
            </select>
            </p></td></tr>
        <tr><td><p>Enter your weight: <input type="text" id="weight"/>
            <select  class = "opt" type="multiple" id="weightunits">
                <option value="kg" selected="selected">kilograms</option>
                <option value="lb">pounds</option>
            </select>
        </p></td></tr>
        <tr><td><input type="submit" class = "opt" value="computeBMI" onclick="computeBMI();">
        <h3>Your BMI is: <span id="output">?</span></h3></td></tr>
        
        <tr><td><h3>This means you are: <span id="comment">?</span></h3></td></tr>
        <tr><td><h3>The normal BMI is between 18 to 25</h3></td></tr>
    </table>
    <?php
    require_once 'scripts.php';
    ?>
    </div>
    </div>
         </body>
        
        </html>