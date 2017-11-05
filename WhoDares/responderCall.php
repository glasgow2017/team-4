<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
    <link rel="stylesheet" href ="ResponderStyle.css">
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
                    <button type="button" class="btn btn-warning navbar-btn">Sign Out</button>
                </div>


            </div>
        </nav>


        <div class="container">

            <p><b><br>Caller Details</b></p>            
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Service</th>
                        <th>Age</th>
                        <th>Issue</th>
                        <th>Number</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                        ini_set('display_errors', 1);
                        ini_set('display_startup_errors', 1);
                        error_reporting(E_ALL);

                        
                        include_once("DBfunctions.php");
                        $conn = getDB();
                        

                            
                            $sql = "SELECT * FROM `Requests` WHERE `PhoneNumber` = 07930849680";

                            $row = $conn->query($sql)->fetch_assoc();
                            $callerName = $row['Name'];
                            $callerService = $row['Sector'];
                            $callerAge = $row['Age'];
                            $callerState = $row['Issue'];
                            $callerNumber = $row['PhoneNumber'];


                            echo '<td name="Name">' . $callerName . '</td>';
                            echo '<td name="Sector">' . $callerService . '</td>';
                            echo '<td name="Age">' . $callerAge . '</td>';
                            echo '<td name="Status">' . $callerState . '</td>';
                            echo '<td name="number"><a href="tel:' . $callerNumber . '">' . $callerNumber . '</a></td>';
                        ?>
                    </tr>
                </tbody>
            </table>
        </div>


        <p class="bodyText"><br><b>Perceived State Feedback</b></p>
        <form id="feedbackInput" action="addResponderFeedback.php">
            <div class="input-group">
                <span class="input-group-addon">Call Start</span>

                <label for="sel1"></label>
                <select class="form-control" id="beforeFeedback">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>

            </div>

            <div class="input-group">
                <span class="input-group-addon">Call End</span>
                <label for="sel1"></label>
                <select class="form-control" id="afterFeedback">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            <div class="submissionButtons">
                <br>


                <button type="submit" class="btn btn-success">Submit Feedback</button>

                <br><br>
                <a href="tel:911"><button type="button" class="btn btn-danger" >Contact Emergency Services</button></a>

            </div>


        </form>


    </body>
</html>


