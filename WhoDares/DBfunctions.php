<?php
include_once('dbconn.inc.php');

function getDB() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    return $conn;
}


function EmailRegister($Email, $Name, $Password, $Age, $Sex){
    if(checkNotUserExists($Email)){
        $conn = getDB();
        $Password = hashPassword($Password);
        $sql = "INSERT INTO users(Email, Name, Password, Age, Sex) VALUES 
        ('".$Email."','".$Name."','".$Password."','".$Age."','".$Sex."')";
        if(!$conn->query($sql)){
            echo $conn->error;
            return false;
        }
        $conn->close();
        return true;
    }
    $conn->close();
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
            $_SESSION['LoggedIn'] = true;
            $conn->close();
            return true;
        }
        else {
            echo "No match 😞";
            $conn->close();
            return false;
        }
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

?>