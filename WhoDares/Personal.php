<?php
session_start();
include_once("DBfunctions.php");
if(isset($_POST["Login"]) && !isset($_SESSION["username"])){
    if(EmailLogin($_POST["username"], $_POST["password"])){
        $_SESSION["username"] = $_POST["username"];
        $user = getProfile($_POST["username"]);
    }else{
        header("Location:index.php");
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

if(isset($_POST["helpPLS"])){
    addToQueue("", "0", "0", $user["Sex"], $user["Age"], "", 5, $user["Number"], $user["Name"]);
    echo ("Added to queue");
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
            <form method="post" action="Personal.php">
                <input type="submit" class="btn btn-primary btn-option" name="helpPLS" value="I would like to talk to someone">
            </form>
        
        
    </div>
        
        <div>
            <form id="updateNumber" name="updateNumber" method="POST">
                Phone Number <input id = "telNum" onkeyup ="checkform()"type="tel" name="telNum" placeholder="<?php echo $user["Number"]; ?>">
                <input type="submit" name="ChangeNum" value="Change Number">
            </form>
            
        </div>
        
        
    </body>
    
</html>