<?php
session_start();
include_once("DBfunctions.php");
if(isset($_POST["Login"]) && !isset($_SESSION["username"])){
    if(EmailLogin($_POST["username"], $_POST["password"])){
        $_SESSION["username"] = $_POST["username"];
        $user = getProfile($_POST["username"]);
    }
}elseif(isset($_SESSION["username"])){
    $user = getProfile($_SESSION["username"]);
}else{
    header("Location:index.php");
}
if(isset($_POST["ChangeNum"])){
    include_once("DBfunctions.php");
    updateNumber($user["Email"],$_POST["telNum"]);
    echo("Number successfully updated");
}
?>

<!DOCTYPE html>
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
        <h1>Welcome <?php echo $user["Name"] ?></h1>
        
        <div class ="user-options">
        <button type="button" class="btn btn-primary btn-option" data-toggle="modal" data-target="#log">I need help</button>
        <button type="button" class="btn btn-success btn-option" data-toggle="modal" data-target="#help">I REALLY NEED HELP</button>
        
    </div>
        
        <div>
            <form id="updateNumber" name="updateNumber" method="POST">
                Phone Number <input id = "telNum" onkeyup ="checkform()"type="tel" name="telNum" placeholder="<?php echo $user["Number"]; ?>">
                <input type="submit" name="ChangeNum" value="Change Number">
            </form>
            
        </div>
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
        
    </body>
    
</html>