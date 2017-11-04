<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
    if(isset($_POST["RegisterMe"])){
        
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
<head>
    <meta charset="UTF-8">
    <title>Who Dares Cares</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Who Dares Cares</a>
        </div>
        <div class = "btn-type">
            <button type="button" class="btn btn-primary navbar-btn">Log In</button>
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
        <input type="submit" name="RegisterMe">
    </form>
    
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
    </script>
    
</body>
</html>
