<!DOCTYPE html5>
<html>
	<head>
		<title>Latest Covid-19 Stats</title>
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
						<a href="index.php" style="">Global Data</a>
						<a href="country.php">Countrywise Data</a>
						<a href="" style="color: white; background-color: #6236ff; text-shadow: 0 0 2px white; box-shadow: 0 0 1em lightgray">Vaccines</a>
						<a href="precautions.php">Precautions</a>
					</div>
				</center>
			</div>
		</div>
		<div class="container" style="padding:3.7vw"></div>
		<div class="filler">
			<img src="assets/Vaccine.png" style="object-fit:contain; width:55vh;"/>
			<div class="fillertextelements" style="display:flex;flex-direction:column;width:45vw;">
				<h1>
				It's all going to be about the COVID-19 variants and the vaccine,
				</h1>
				<h3>and that will determine where we're going to be next year, the year after, and the year after that.</h3>
			</div>
		</div>
		<div class="container" style="display:flex;flex-direction:column;">
			<div style="display:flex; flex-direction:row;justify-content:space-between;background-color:white">
				<select id="dropdown" style="margin-bottom:8vh;width:40%;min-width:fit-content"  onchange="window.open(this.value,'_self');">
					<option value="Vaccines.php">Vaccines authorized for Use</option>
					<option value="preclinical.php">Pre-Clinical Vaccines</option>
					<option value="ph1.php">Phase 1 Vaccines</option>
					<option value="ph2.php">Phase 2 Vaccines</option>
					<option value="ph3.php">Phase 3 Vaccines</option>
					<option value="ph4.php">Phase 4 Vaccines</option>
					<option value="treatments.php">FDA Approved Treatments</option>
				</select>
			<?php

				$curl = curl_init();

				curl_setopt_array($curl, [
					CURLOPT_URL => "https://vaccovid-coronavirus-vaccine-and-treatment-tracker.p.rapidapi.com/api/vaccines/get-fda-approved-vaccines",
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_FOLLOWLOCATION => true,
					CURLOPT_ENCODING => "",
					CURLOPT_MAXREDIRS => 10,
					CURLOPT_TIMEOUT => 30,
					CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					CURLOPT_CUSTOMREQUEST => "GET",
					CURLOPT_HTTPHEADER => [
						"x-rapidapi-host: vaccovid-coronavirus-vaccine-and-treatment-tracker.p.rapidapi.com",
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
					$count=0;
					foreach($response as $i)
					{
						$count++;
					}
					echo("<h4 style='color:#1cb142;background-color:white;font-size:2vw;font-family:sans-serif'>$count Results(s)</h4>");
					echo("</div>");
					echo("<table style='font-size:1.8vw;'>");
					echo("<tr>");
					echo("<th>DEVELOPER/RESEARCHER</th>");
					echo("<th>CATEGORY</th>");
					echo("<th>PHASE</th>");
					echo("<th>LAST UPDATED</th>");
					echo("</tr>");
					foreach($response as $i)
					{
						$dev=strtoupper(str_replace("-"," ",$i->trimedName));
						$category=$i->category;
						$phase=$i->phase;
						$update=$i->lastUpdated;
						echo("<tr style='font-size:1vw;font-weight:lighter; height:5.5vh;'>");
						echo("<td>$dev</td>");
						echo("<td>$category</td>");
						echo("<td>$phase</td>");
						echo("<td>$update</td>");
						echo("</tr>");
					}
					echo("</table>");
				}
			?>
		</div>
	</body>
	<footer id='footer'>
		&#169; Copyright. All Rights Reserved
	</footer>
</html>