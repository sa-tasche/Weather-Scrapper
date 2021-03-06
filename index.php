<?php
	$weather = "";
	$error = "";
	if (array_key_exists('city', $_GET)){

		$city = str_replace(' ', '', $_GET['city']);

		$file_headers = @get_headers("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");

		if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
			$error = "Your city could not be found.";
		} else {

		$forecastPage=file_get_contents("https://www.weather-forecast.com/locations/".$city."/forecasts/latest");
		$pageArray = explode('(1–3 days)</div><p class="b-forecast__table-description-content"><span class="phrase">', $forecastPage);

		if(sizeof($pageArray) > 1){

			$secondPageArray=explode('</span></p></td><td class="b-forecast__table-description-cell--js" colspan="9">', $pageArray[1]);

			if(sizeof($secondPageArray) > 1){

			$weather = $secondPageArray[0];

			}else{
				$error = "Your city could not be found.";
			}

		} else{
			$error = "Your city could not be found.";
		}

		}
	}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather Scrapper</title>
    <link rel="shortcut icon" href="favicon.png">

    <style type="text/css">
    	html { 
			  background: url(background.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}

		body{
			background: none;
		}

		.container{
			text-align: center;
			margin-top: 100px;
			width: 450px;
		}

		input{
			margin: 20px 0;
		}

		#weather{
			margin-top: 15px;
		}



    </style>
  </head>
  <body>
  	
  	<div class="container">
			<a href="https://github.com/ankit-kaushal" class="github-corner" aria-label="View source on GitHub"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#151513; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
  		
  		<h1>What's The Weather?</h1>

  		<form>
		  <div class="form-group">
		    <label for="city">Enter the name of your city.</label>
		    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Kolkata" value="<?php 

		    if (array_key_exists('city', $_GET)){

		    	echo $_GET['city']; 
			
			}

		    ?>">
		  </div>
		  	<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		<div id="weather"><?php

			if($weather){

			echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';

			}
			else if ($error){
				echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
			}

		?></div>


  	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>