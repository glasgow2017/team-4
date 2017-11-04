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
                    <button type="button" class="btn btn-warning navbar-btn">Sign Out</button>
                </div>


            </div>
        </nav>


        <div class="container">

            <p><b><br>Caller Details:</b></p>            
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Service</th>
                        <th>Age</th>
                        <th>State</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John Doe</td>
                        <td>Ex-Military</td>
                        <td>37</td>
                        <td>Feeling uneasy</td>
                    </tr>

                </tbody>
            </table>
        </div>
        
        
        <p id="feedbackInput"><br><b>Perceived State Feedback</b></p>
        <form id="feedbackInput">
            <div class="input-group">
                <span class="input-group-addon"><-</span>

                <label for="sel1"></label>
                <select class="form-control">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>

            </div>
            
            <div class="input-group">
                <span class="input-group-addon">-></span>
                <label for="sel1"></label>
                <select class="form-control" id="afterFeedback">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
        </form>
        
        <div class="submissionButtons">
            <br>
            <button type="button" class="btn btn-success">Submit Feedback</button>
            <br><br>
            <button type="button" class="btn btn-danger">Contact Emergency Services</button>
        </div>
        


    </body>
</html>


