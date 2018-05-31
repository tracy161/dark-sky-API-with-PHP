<?php

	$coordinates = '-37.7722,144.9994';

	$api_url = 'https://api.darksky.net/forecast/7608e52e3fdae7f59e1cec1326de837a/'.$coordinates;

	$forecast = json_decode(file_get_contents($api_url));

	// echo '<pre>';
	// print_r($forecast);
	// echo '</pre>';

	//Current Conditions
	$temperature_current = round($forecast->currently->temperature);
	$summary_current = $forecast->currently->summary;
	$windspeed_current = round($forecast->currently->windSpeed);
	$humidity_current = $forecast->currently->humidity*100;

	// Set time zone based on location searched
	date_default_timezone_get($forecast->timezone);

?>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Forecast</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
</head>
<body>
	<main class="container text-center">
		<h1 class="display-1">Forecast</h1>
		<div class="card p-4" style="margin: 0 auto; max-width: 320px;">
			<h2>Current Temperature</h2>
			<h3 class="display-2"><?php echo $temperature_current; ?>&deg;</h3>
			<h3>Humidity: <?php echo $humidity_current;?>%</h3>
			<p class="lead"><?php echo $summary_current;?></p>
			<p class="lead">Wind Speed: <?php echo $windspeed_current;?><abbr title="miles per hour"> MPH</abbr></p>
		</div>

		<ul class="list-group" style="margin: 0 auto; max-width: 320px;">
			<?php 
			// start the foreach loop to display hourly forcast
			foreach ($forecast->hourly->data as $hour): 
				
			?>
		  <li class="list-group-item"><?php echo round($hour->temperature);?>&deg;</li>

		  <?php
		  	// end the foreach loop
			endforeach;
		  ?>
		  
		</ul>
	</main>
</body>
</html>