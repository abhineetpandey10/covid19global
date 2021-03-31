<!DOCTYPE html>
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
						<a href="" style="color: white; background-color: #6236ff; text-shadow: 0 0 2px white; box-shadow: 0 0 1em lightgray">Countrywise Data</a>
						<a href="vaccines.php">Vaccines</a>
						<a href="precautions.php">Precautions</a>
					</div>
				</center>
			</div>
		</div>
		<div class="container" style="padding:3.7vw"></div>
		<div class="filler">
			<center>
				<img src='assets/worldmap.png'
			 			style= "background-color:white;
						object-fit:contain;
						height:55vh;width:90vw;"
						alt="World map"/>
			</center>
		</div>
		<div class="filler" style="justify-content:space-between">
			<div class="list">
				<form method='post' id="form">
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
						$region_names=array();
						$count=0;
						foreach($response->data->regions as $i)
						{
							$region_names[$count]="<center><input type='submit' name='submit' value='$i->name' id='listItem'/></center>";
							$count++;
							//echo("<center><input type='submit' name='submit' value='$i->name' id='listItem'/></center>");
						}
						sort($region_names);
						foreach($region_names as $i)
						{
							echo($i);
						}
					}
				?>
				</form>
			</div>
			<div class="container" style="padding-right: 15vh">
				<?php
					function printChange($value)
					{
						if($value==abs($value))
						{
							echo("<td style='color:#1CB142'> &#9650;" .$value ."</td>");
						}
						else
						{
							echo("<td style='color:#f9345e'> &#9660;" .$value ."</td>");
						}
					}
					if(isset($_POST['submit']))
					{
						$region=$_POST['submit'];
						$region=strtolower(str_replace(" ","_",$region));
						echo("<table>");
						echo("<tr>");
						$countryname=strtoupper(str_replace("_"," ",$region));
						echo("<td colspan=3 style='background-color:white; color: brown; box-shadow: 0 0 1em 1px lightgray;'>COUNTRY: $countryname</td>");
						echo("</tr>");
						echo("<tr>");
						echo("<th></th>");
						echo("<th>COUNT</th>");
						echo("<th style='color:#6236ff'>CHANGE</th>");
						echo("</tr>");
						echo("<tr>");
						echo("<td>Total Cases</td>");
						echo("<td>"); 
						echo($response->data->regions->$region->total_cases);
						echo("</td>");
						printChange($response->data->regions->$region->change->total_cases);
						echo("</tr>");
						echo("<tr>");
						echo("<td>Active Cases</td>");
						echo("<td>" .$response->data->regions->$region->active_cases ."</td>");
						printChange($response->data-> regions->$region->change->active_cases);
						echo("</tr>");
						echo("<tr>");
						echo("<td>Deaths</td>");
						echo("<td>" .$response->data->regions->$region->deaths ."</td>");
						printChange($response->data-> regions->$region->change->deaths);
						echo("</tr>");
						echo("<tr>");
						echo("<td>Recovered</td>");
						echo("<td>" .$response->data->regions->$region->recovered ."</td>");
						printChange($response->data-> regions->$region->change->recovered);
						echo("</tr>");
						echo("<tr>");
						echo("<td>Death Ratio</td>");
						echo("<td>");
						printf("%1.4f",$response->data->regions->$region->death_ratio);
						echo("</td>");
						
						if($response->data-> regions->$region->change->death_ratio==abs($response->data-> regions->$region->change->death_ratio))
						{
							echo("<td style='color:#1cb142'>&#9650;" );
							printf("%1.2e",$response->data-> regions->$region->change->death_ratio);
							echo("</td>");
						}
						else
						{
							echo("<td style='color:#f9345e'>&#9660;" );
							printf("%1.2e",$response->data-> regions->$region->change->death_ratio);
							echo("</td>");
						}
						echo("</tr>");
						echo("<tr>");
						echo("<td>Recovery Ratio</td>");
						echo("<td>");
						printf("%1.4f",$response->data->regions->$region->recovery_ratio);
						echo("</td>");
						if($response->data-> regions->$region->change->recovery_ratio==abs($response->data-> regions->$region->change->recovery_ratio))
						{
							echo("<td style='color:#1cb142'>&#9650;" );
							printf("%1.2e",$response->data-> regions->$region->change->recovery_ratio);
							echo("</td>");
						}
						else
						{
							echo("<td style='color:#f9345e'>&#9660;" );
							printf("%1.2e",$response->data-> regions->$region->change->recovery_ratio);
							echo("</td>");
						}
						echo("</tr>");
						echo("</table>");
					}
					else 
						echo("<h1>Select a country to continue</h1>") 
				?>
			</div>
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