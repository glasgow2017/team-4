<?php
include_once('dbconn.inc.php');

function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function EmailRegister($Email, $Name, $Password, $Age, $Sex, $Phone){
    if(checkNotUserExists($Email)){
        $conn = getDB();
        $Password = hashPassword($Password);
        $sql = "INSERT INTO users(Email, Name, Password, Age, Sex, Number) VALUES 
        ('".$Email."','".$Name."','".$Password."','".$Age."','".$Sex."','".$Phone."')";
        if(!$conn->query($sql)){
            echo $conn->error;
            return false;
        }
        $conn->close();
        return true;
    }
    return false;
}
function EmailLogin($Email, $Password) {
    $conn = getDB();
    $sql = "SELECT Password FROM users WHERE Email='".$Email."'";
    if($r = $conn->query($sql)) {
        $result = $r->fetch_assoc();
        $password = $result['Password'];
        if(password_verify($Password, $password)) {
            if (password_needs_rehash($password, PASSWORD_DEFAULT, ['cost' => 12])) {
                $password = hashPassword($Password);
                $sql = "UPDATE users SET Password='".$password."' WHERE Email='".$Email."'";
                if(!$conn->query($sql))
                    return false;
            }
            $conn->close();
            return true;
        }
        else {
            echo "No match 😞";
            $conn->close();
            return false;
        }
    }else{
        return false;
    }

}


function hashPassword($Password) { // Call this during registration as well as during login iff hash has changed
    $Password =  password_hash($Password, PASSWORD_DEFAULT, ['cost' => 12]);
    return $Password;
}

function checkNotUserExists($Email){
    //checks if a user doesnt already exist with a given email, returns true if they dont
    $conn = getDB();
    $result1 = $conn->query("SELECT Email FROM users WHERE Email='".$Email."'")->num_rows;
    $conn->close();
    return ($result1 == 0);
}

function addToQueue($Sector, $Lat, $Lon, $Sex, $Age, $Issue, $Urgency, $PhoneNumber, $Name){
    $conn = getDB();
    $conn->query("INSERT INTO Requests(Sector, Lat, Lon, Sex, Age, Issue, Urgency, PhoneNumber, Name) VALUES ('".$Sector."','".$Lat."','".$Lon."','".$Sex."','".$Age."','".$Issue."','".$Urgency."','".$PhoneNumber."','".$Name."')");
    $conn->close();
}

function getProfile($Email){
    $conn = getDB();
    $profile = $conn->query("SELECT * FROM users WHERE Email='".$Email."'")->fetch_assoc();
    $conn->close();
    return $profile;
}

function addToCallCheck($person){
    $conn = getDB();
    $profile = $conn->query("INSERT INTO callCheck(Name, Service, Age, Issue, Number) VALUES ('".$person["Name"]."','".$person["Service"]."','".$person["Age"]."','".$person["Issue"]."','".$person["Number"]."')");
    $conn->close();
}

function updateNumber($Email, $Number){
    $conn = getDB();
    $conn->query("UPDATE users SET Number=".$Number." WHERE Email='".$Email."'");
    $conn->close();
}
?>