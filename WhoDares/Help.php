
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html lang="en">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/css/bootstrap-slider.css">
<link rel="stylesheet" href ="Style.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/9.9.0/bootstrap-slider.js"></script>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8">
    <title>Who Dares Cares</title>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Who Dares Cares</a>
        </div>
        <div class = "btn-type">
            <button type="button" class="btn btn-primary navbar-btn">Log In</button>
            <button type="button" class="btn btn-warning navbar-btn">Register</button>
        </div>
    </div>
</nav>
<div class="form-group sector-dd">
  <label for="sel1">Sector</label>
  <select onchange = "checkform()"class="form-control" id="sectorSelect">
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
  <select onchange = "checkform()" class="form-control" id="issueSelect">
    <option selected="selected" disabled = "disabled">Choose option</option>
    <option>Stress</option>
    <option>Depression</option>
    <option>Loneliness</option>
    <option>Anxiety</option>
  </select>
</div>
    <div class ="btn-submithelp">
        <button type="button" class="btn btn-primary btn-Help" id ="btn-Help" disabled="disabled">Get Help</button>
    </div>
    <input id="rating" data-slider-id='rating' type="text" data-slider-min="0" data-slider-max="5" data-slider-step="1" data-slider-value="3"/>
    
</body>
    <script type="text/javascript" language="javascript">
        function checkform()
        {
            
            if(document.getElementById("issueSelect").value != "Choose option" && document.getElementById("sectorSelect").value != "Choose option"){
                document.getElementById("btn-Help").disabled = false;
            }
         
        }
        $('#rating').slider({
	formatter: function(value) {
		return 'Current value: ' + value;
	}
        
});

        
    </script>
</html>