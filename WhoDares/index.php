<?php
if(isset($_POST["HELPNOW"])){
    include_once("DBfunctions.php");
    addToQueue($_POST["Sector"], 0, 0, 0, 0, $_POST["Issue"], 10, $_POST["PhoneNumber"]);
}
?>

<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href ="Style.css">

    <meta charset="UTF-8">
    <title>Who Dares Cares</title>
</head>
    
    <script>
        function postReq(){
            var http = new XMLHttpRequest();
            var url = "index.php";
            var form = document.forms["helpForm"];
            var params = "HELPNOW=" + form.elements['HELPNOW'].name + "&Sector=" + form.elements["Sector"].value + "&Issue=" + form.elements["Issue"].value + "&PhoneNumber=" + form.elements["telNum"].value;
            http.open("POST", url, true);
            
            //Send the proper header information along with the request
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState == 4 && http.status == 200) {
                    alert(http.responseText);
                }
            }
            http.send(params);
        }
    </script>
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Who Dares Cares</a>
        </div>
        <div class = "btn-type nav-options">
            <button type="button" class="btn btn-primary navbar-btn" data-toggle="modal" data-target="#log" >Log In</button>
            <a href = "Register.php"><button type="button" class="btn btn-warning navbar-btn" >Register</button></a>
        </div>
    </div>
</nav>
    <div class ="user-options">
        <button type="button" class="btn btn-primary btn-option" data-toggle="modal" data-target="#log">Log in to Get help</button>
        <button type="button" class="btn btn-success btn-option" data-toggle="modal" data-target="#help">Get help immediately</button>
        
    </div>
          <!-- Modal -->
<div id="log" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Log In</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="inputContainer modal-body">
        <form action="/action_page.php">
            <div class="inputFields">
                Username: <input onkeyup = "checkSubmit()" id = "username" type="text" name="username"><br>
                Password: <input onkeyup = "checkSubmit()" id = "password" type="text" name="password"><br><br>
                <input id= "submitBtn" type="submit" value="Submit" disabled = true>
            </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
              <!-- Modal -->
<div id="help" class="modal" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Log In</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        
      </div>
      <div class="inputContainer modal-body">
        <form onsubmit="postReq()" id="helpForm">
                        <div class="form-group sector-dd">
              <label for="sel1">Sector</label>
              <select onchange = "checkform()"class="form-control" id="sectorSelect" name="Sector">
                <option selected="selected" disabled = "disabled">Choose option</option>
                <option>Army Vet</option>
                <option>Fire service</option>
                <option>Police</option>
                <option>NHS</option>
              </select>
            </div>
                <br>
                <br>
            <div class="form-group sector-dd">
              <label for="sel1">Issue</label>
              <select onchange = "checkform()" class="form-control" id="issueSelect" name="Issue">
                <option selected="selected" disabled = "disabled">Choose option</option>
                <option>Stress</option>
                <option>Depression</option>
                <option>Loneliness</option>
                <option>Anxiety</option>
              </select>
            </div>
                
                <div class ="btn-submithelp">
                    <br>Phone Number <input id = "telNum"onchange = "checkform()" onkeyup ="checkform()"type="number" name="telNum"><br><br>
                    <input type="submit" class="btn btn-primary btn-Help" id ="btn-Help" disabled="disabled" name="HELPNOW" value="Get Help">
                </div>
        </form>
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
              <p id="test"></p>
<script type="text/javascript" language="javascript">
        function checkform()
        {
            
            if(document.getElementById("issueSelect").value != "Choose option" && document.getElementById("sectorSelect").value != "Choose option" && document.getElementById("telNum").value.length == 11){
                document.getElementById("btn-Help").disabled = false;
            }else{
                document.getElementById("btn-Help").disabled = true;
            }
         
        }
        function checkSubmit()
        {
            
            if(document.getElementById("username").value != "" && document.getElementById("password").value != ""){
                document.getElementById("submitBtn").disabled = false;
            }else{
                document.getElementById("submitBtn").disabled = true;
            }
         
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
    </script>


    
</body>
</html>
