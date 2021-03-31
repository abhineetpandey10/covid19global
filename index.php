<!DOCTYPE html5>
<html>
	<head>
		<title>Latest Covid-19 Stats</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		<link rel="stylesheet" href="styles.css"/>
	</head>
	<body>
		<div class="header">
			<img src="assets/covidicon.png" alt="covid-19 animated"/>
			<div class="headercontent">
				<center>
					<div class="sitename">
						<span
							style="font-size: 3vw; color: #F9345E; 
									font-family: sans-serif; font-weight:bolder"	
						>
							Covid-19 &#160;
						</span>
						<span
							style="font-size: 3vw; color: #1CB142; 
									font-family: sans-serif;"
						>
							Global Trends and updates
						</span>	
					</div>
				</center>
				<center>
					<div class="menubar">
						<a href="" style="color: white; background-color: #6236ff; text-shadow: 0 0 2px white; box-shadow: 0 0 1em lightgray">Global Data</a>
						<a href="country.php">Countrywise Data</a>
						<a href="vaccines.php">Vaccines</a>
						<a href="precautions.php">Precautions</a>
					</div>
				</center>
			</div>
		</div>
		<div class="container" style="padding:3.7vw"></div>
		<div class="filler">
			<div class="fillertext">
						<div class="fillertextelements">
							<img src='assets\bullet.png' style="background-color:white;padding-right:2em;object-fit:contain;width:25px"/>
							<h1>226</h1>
							<h3>Regions worldwide from where data is collected.</h3>
							</div>
						<div class="fillertextelements">
							<img src='assets\bullet.png' style="background-color:white;padding-right:2em;object-fit:contain;width:25px"/>
							<h1>Vaccine Information</h1>
							<h3>from all over the world</h3>
						</div>
						<div class="fillertextelements">
							<img src='assets\bullet.png' style="background-color:white;padding-right:2em;object-fit:contain;width:25px"/>
							<h1>Up to date Data</h1>
							<h3>about Covid-19 and the vaccines from around the world</h3>
						</div>
			</div>
				<img src="assets/doctor.png" style="background-color: white"/>
			</div>
		<div class="container">
			<?php

				$curl = curl_init();

				curl_setopt_array($curl, [
				CURLOPT_URL => "https://coronavirus-map.p.rapidapi.com/v1/summary/latest",
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_ENCODING => "",
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 30,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => "GET",
				CURLOPT_HTTPHEADER => [
					"x-rapidapi-host: coronavirus-map.p.rapidapi.com",
					"x-rapidapi-key: 0eaa1eb6a3msh3ea1868fce9482fp11c5e7jsnc4c99dec597a"
					],
				]);

				$response = curl_exec($curl);
				$err = curl_error($curl);

				curl_close($curl);

				if ($err)
				{
					echo "cURL Error #:" . $err;
				}
				else
				{
					$response=json_decode($response);
					
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Total Cases</h3>");
					echo("<h1 style='color:#6236ff'>");
					echo($response->data->summary->total_cases);
					echo("</h1>");
					if(abs($response->data->change->total_cases)==$response->data->change->total_cases)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->total_cases);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->total_cases);
						echo("</h5>");
					} 
					echo("<center>");
					echo("</div>");
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Active Cases</h3>");
					echo("<h1 style='color:brown'>");
					echo($response->data->summary->active_cases);
					echo("</h1>");
					if(abs($response->data->change->active_cases)==$response->data->change->active_cases)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->active_cases);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->active_cases);
						echo("</h5>");
					}
					echo("<center>");
					echo("</div>");
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Deaths</h3>");
					echo("<h1 style='color:darkgray'>");
					echo($response->data->summary->deaths);
					echo("</h1>");
					if(abs($response->data->change->deaths)==$response->data->change->deaths)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->deaths);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->deaths);
						echo("</h5>");
					}
					echo("<center>");
					echo("</div>");
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Recovered</h3>");
					echo("<h1 style='color:#6236ff'>");
					echo($response->data->summary->recovered);
					echo("</h1>");
					if(abs($response->data->change->recovered)==$response->data->change->recovered)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->recovered);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->recovered);
						echo("</h5>");
					}
					echo("<center>");
					echo("</div>");
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Critical</h3>");
					echo("<h1 style='color:brown'>");
					echo($response->data->summary->critical);
					echo("</h1>");
					if(abs($response->data->change->critical)==$response->data->change->critical)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->critical);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->critical);
						echo("</h5>");
					}
					echo("<center>");
					echo("</div>");
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Tested</h3>");
					echo("<h1 style='color:darkgray'>");
					echo($response->data->summary->tested);
					echo("</h1>");
					if(abs($response->data->change->tested)==$response->data->change->tested)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->tested);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->tested);
						echo("</h5>");
					}
					echo("<center>");
					echo("</div>");
					
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Death Ratio</h3>");
					echo("<h1 style='color:#6236ff'>");
					printf("%1.4f",$response->data->summary->death_ratio);
					echo("</h1>");
					if(abs($response->data->change->total_cases)==$response->data->change->death_ratio)
					{
						echo("<h5 style=\"color:green\">&#9650;");
						echo($response->data->change->death_ratio);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->death_ratio);
						echo("</h5>");
					} 
					echo("<center>");
					echo("</div>");
					echo("<div class=\"card\">");
					echo("<center>");
					echo("<h3>Recovery Ratio</h3>");
					echo("<h1 style='color:brown'>");
					printf("%1.4f",$response->data->summary->recovery_ratio);
					echo("</h1>");
					if(abs($response->data->change->recovery_ratio)==$response->data->change->recovery_ratio)
					{
						echo("<h5 style=\"color:green\">&#9650;" 	);
						echo($response->data->change->recovery_ratio);
						echo("</h5>");
					}
					else
					{
						echo("<h5 style=\"color:red\"> &#9660;");
						echo($response->data->change->recovery_ratio);
						echo("</h5>");
					}
					echo("<center>");
					echo("</div>");
				}
			?>
		</div>
		<?php
			echo("<span id='removable'>");
			echo($response->data->generated_on);
			echo("</span>"); 
		?>
	</body>
	<footer id='footer'>
		&#169; Copyright. All Rights Reserved
	</footer>
	<script>
			var msec=document.getElementById('removable').innerHTML;
			//console.log(new Date(parseInt(msec)));
			var d=new Date(parseInt(msec*1000));
			document.getElementById('removable').innerHTML='';
			document.getElementById('footer').innerHTML=document.getElementById('footer').innerHTML+" | Last Updated: "+d.toString();
		</script>
</html>
