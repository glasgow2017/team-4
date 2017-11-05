<?php
/**
 * Created by PhpStorm.
 * User: alexanderjmackechnie
 * Date: 04/11/2017
 * Time: 19:22
 */

function cmp($a, $b) {
    return $a["Urgency"] - $b["Urgency"];
}

function distance($lat1, $lon1, $lat2, $lon2, $unit) {

    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
        return ($miles * 1.609344);
    } else if ($unit == "N") {
        return ($miles * 0.8684);
    } else {
        return $miles;
    }
}

// -----------------------------------------Connect to the Database -----------------------------------//

$link = mysqli_connect("localhost", "AlexMackechnie", "Zander1996", "code_for_good");

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
} elseif ($link == true) {
    echo "connected to database";
    echo "<br>";
    echo "<br>";
}

// ----------------------------------------- Insert into database  ------------------------------------//


//    $sql = "INSERT INTO data (Sector, Lat, Lon, Sex, Age, Issue Urgency, PhoneNumber)
//    VALUES ('dsfdsfds', '20,000', '20.000', 'm', '20', 'Depression', '7', '07554044965')";
//
//    if ($link->query($sql) === TRUE) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $sql . "<br>" . $link->error;
//    }
//
//    $sql2 = "INSERT INTO responders (Sector, Lat, Lon, Sex, Age, Specialty, Availability)
//              VALUES ('dsfdsfds', '20,000', '20.000', 'm', '20', 'Depression', '1')";
//
//    if ($link->query($sql2) === TRUE) {
//        echo "New record created successfully";
//    } else {
//        echo "Error: " . $sql2 . "<br>" . $link->error;
//    }

// ------------------------- Build two arrays for users and responders  --------------------------------//

$users = [[]];

$result = $link->query("SELECT * FROM data");

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $arr = array("Sector" => $row["Sector"], "Lat" => $row["Lat"], "Lon" => $row["Lon"],
            "Sex" => $row["Sex"], "Age" => $row["Age"], "Issue" => $row["Issue"],
            "Urgency" => $row["Urgency"], "PhoneNumber" => $row["PhoneNumber"]);
        array_push($users, $arr);
    }
} else {
    echo "0 results";
}

$responders = [[]];

$result2 = $link->query("SELECT * FROM responders");

echo "RESPONDERS";
echo "<br>";
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
        $arr2 = array("Sector" => $row2["Sector"], "Lat" => $row2["Lat"], "Lon" => $row2["Lon"],
            "Sex" => $row2["Sex"], "Age" => $row2["Age"],
            "Specialty" => $row2["Specialty"], "Availability" => $row2["Availability"]);
        array_push($responders, $arr2);
        echo $row2["Sector"] . " " . $row2["Lat"] . " " . $row2["Lon"]
            . " " . $row2["Sex"] . " " . $row2["Age"] . " " . $row2["Specialty"]
            . " " . $row2["Availability"];
        echo "<br>";
    }
} else {
    echo "0 results";
}


// ------------------------------------SORT USERS DATABASE BY URGENCY ----------------------------------//

//    foreach($users as $small){
//        foreach($small as $value) {
//            echo $value . " ";
//        }
//        echo "<br>";
//    }

usort($users, "cmp");
$users = array_reverse($users);
//
echo "<br><br>";
echo "USERS";
echo "<br>";
for ($i = 0; $i < sizeof($users); $i++) {
    echo $users[$i]["Sector"] . " " . $users[$i]["Lat"] . " " .
        $users[$i]["Lon"] . " " . $users[$i]["Sex"] . " " .
        $users[$i]["Age"] . " " . $users[$i]["Issue"] . " " .
        $users[$i]["Urgency"] . " " . $users[$i]["PhoneNumber"];
    echo "<br>";
}

echo "<br><br>";

//    foreach($users as $small){
//        foreach($small as $value) {
//            echo $value . " ";
//        }
//        echo "<br>";
//    }

// ------------------------------------------------------------------------------------------------//

$users = array_values($users);
$responders = array_values($responders);

echo "<br><br>";
echo $users[0]["Sector"];
echo "<br>";
echo $responders[1]["Sector"];
echo "<br><br>";

$callsCompleted = false;

while (!$callsCompleted) {

    $sum = 0;

//        $availabilityArray = $responders['Availability'];
//        echo array_sum(array_column($responders,'Availability'));
    while (array_sum(array_column($responders,'Availability')) == 0) {
        sleep(2);
    }

    for ($i = 0; $i < sizeof($users) - 1; $i++) {

        $responderScores = array_fill(0, sizeof($responders), 0);
        $responderDistances = array_fill(0, sizeof($responders), 0);

        echo $responderScores[1] . " " . $responderScores[2] . " " . $responderScores[3] . "<br>";

        //Responders array starts from 1.
        for ($j = 1; $j < sizeof($responders); $j++) {
//            echo $j;
//            echo $users[$i]['Urgency'];

            $bestLocation = 1;

            if ($responders[$j]['Availability'] != 0) {
//                echo $responders[$j]['Availability'];

                //Rate the responder based on the Sector.
                if (($users[$i]['Sector'] == $responders[$j]['Sector'])) {
                    $responderScores[$j] = $responderScores[$j] + 50;
                }

                //Rate the responder based on the specialities they have.
                if (strpos($responders[$j]['Specialty'], $users[$i]['Issue']) !== false) {
                    $responderScores[$j] = $responderScores[$j] + 40;
                }

                //Rate the responder based on the Sector.
                if (($users[$i]['Sex'] == $responders[$j]['Sex'])) {
                    $responderScores[$j] = $responderScores[$j] + 20;
                }

                //Rate the responder based on their Age.
                if ($users[$i]['Age'] > $responders[$j]['Age'] - 5 && $users[$i]['Age'] < $responders[$j]['Age'] + 5) {
                    $responderScores[$j] = $responderScores[$j] + 20;
                }

                //Find the index of the closest responder.
                $responderDistances[$j] = distance($responders[$j]['Lat'], $responders[$j]['Lon'],
                    $users[$i]['Lat'], $users[$i]['Lon'], "M");

                if ($j > 1) {
                    if ($responderDistances[$j] < $responderDistances[$j - 1]) {
                        $bestLocation = $j;
                    }
                }
            }


        }


        if (!($responders[$bestLocation]['Availability'] == 0)) {
            $responderScores[$bestLocation] += 20;
        }

        echo $responderDistances[1] . ", " . $responderDistances[2] . ", " . $responderDistances[3] . "<br>";
        echo $responderScores[1] . ", " . $responderScores[2] . ", " . $responderScores[3] . "<br><br>";

    }

    $ma = array_keys($responderScores, max($responderScores));
    echo $ma[0];

    $callsCompleted = true;
}

//Users array starts from 0.

echo "<br><br>finished";



?>