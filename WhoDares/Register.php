<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    if(isset($_POST["RegisterMe"])){
        include_once("DBfunctions.php");
        if(EmailRegister(strip_tags($_POST["Email"]), strip_tags($_POST["Name"]), strip_tags($_POST["Password1"]), strip_tags($_POST["Age"]), strip_tags($_POST["Sex"]), strip_tags($_POST["Phone"]))){
            //echo "User: ".$_POST["Email"]." successfully registered.";
            echo '<script language="javascript">';
            echo 'alert("User: ".$_POST["Email"]." successfully registered.")';
            echo '</script>';
        }else{
            //echo "Error in registration";
            echo '<script language="javascript">';
            echo 'alert("Error in registration")';
            echo '</script>';
        }
    }
//var_dump($_POST);
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href ="Style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<head>
    <meta charset="UTF-8">
    <title>Who Dares Cares</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Who Dares Cares</a>
        </div>
        <div class = "btn-type">
            <button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#log"  >Log In</button>
        </div>
    </div>
</nav>
    
    
    <form name="RegisterForm" id="RegisterForm" method="POST" onsubmit="return verify()">
        <input type="text" name="Name" placeholder="Name" required><br>
        <input type="email" name="Email" placeholder="Email address" required><br>
        <input type="password" name="Password1" id="Password1" placeholder="Password" required><br>
        <input type="password" name="Password2" id="Password2" placeholder="Re-enter password" required><br>
        <input type="number" step="1" min="0" name="Age" placeholder="Age" required><br>
        <input type="text" name="Sex" placeholder="Sex" required><br>
        <input type="tel" name="Phone" placeholder="Phone number" required><br>
        <input type="submit" onsubmit ="getLocation()" name="RegisterMe">
    </form>
    <p id="test"></p>
    <script>
    function verify(){
        password1 = document.getElementById("Password1").value;
        password2 = document.getElementById("Password2").value;
        if(password1 != password2){
            alert("Passwords do not match, please try again");
            return false;
        }
        return true;
    }
    function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
               //NOT supported - DO SOMETHING
            }
        }

        function showPosition(position) {
            document.getElementById('test').innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
        }
        function checkSubmit()
        {
            
            if(document.getElementById("username").value != "" && document.getElementById("password").value != ""){
                document.getElementById("submitBtn").disabled = false;
            }else{
                document.getElementById("submitBtn").disabled = true;
            }
         
        }
    </script>
    <div id="log" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Log In</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="inputContainer modal-body">
        <form action="Personal.php" method="post">
            <div class="inputFields">
                Username: <input onkeyup = "checkSubmit()" id = "username" type="text" name="username"><br>
                Password: <input onkeyup = "checkSubmit()" id = "password" type="password" name="password"><br><br>
                <input id="submitBtn" type="submit" value="Submit" name="Login" disabled = true>
            </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
    
</body>
</html>
