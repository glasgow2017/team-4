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
<body>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">Who Dares Cares</a>
        </div>
        <div class = "btn-type">
            <button type="button" class="btn btn-primary navbar-btn" >Log In</button>
            <button type="button" class="btn btn-warning navbar-btn">Register</button>
        </div>
    </div>
</nav>
    <div class ="user-options">
        <button type="button" class="btn btn-primary btn-option" data-toggle="modal" data-target="#log">Log in to Get help</button>
        <a href = "Help.php"><button type="button" class="btn btn-success btn-option">Get help immediately</button></a>
        
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
                Username: <input type="text" name="username"><br>
                Password: <input type="text" name="password"><br><br>
                <input type="submit" value="Submit">
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
