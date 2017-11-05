<?php
if(isset($_POST["Login"]) && !isset($_SESSION["username"])){
    include_once("DBfunctions.php");
    if(EmailLogin($_POST["username"], $_POST["password"])){
        session_start();
        $_SESSION["username"] = $_POST["username"];
        $user = getProfile($_POST["username"]);
    }
}elseif(isset($_SESSION["username"])){
    $user = getProfile($_SESSION["username"]);
}else{
    header("Location:index.php");
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
        <button type="button" class="btn btn-primary btn-option" data-toggle="modal" data-target="#log">Log in to Get help</button>
        <button type="button" class="btn btn-success btn-option" data-toggle="modal" data-target="#help">Get help immediately</button>
        
    </div>
        
    </body>
    
</html>