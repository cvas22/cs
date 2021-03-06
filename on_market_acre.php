<?php
/**
* Created by PhpStorm.
* User: Srinivas
* Date: 3/15/2016
* Time: 1:57 AM
*
* This script generates average, high, and low values of acres per city, county, zip, and state
*/

// Connect to the database
include "tools/connect.php";


echo "PHP Scripted started... Please wait" . '<br> <br>' ;
//Get city list from the stats_geo table
$SQLQuery = "SELECT id, city, zip, county, state FROM stats_geo";
$result_city = $conn->query($SQLQuery);

while($data=mysqli_fetch_array($result_city, MYSQLI_NUM)) 
{

//For each result in city, county, zip, fetch the average, min, max values of acres
$SelectQ = "SELECT avg(dimacres) as average_acres,
       min(dimacres) as min_acres,
       max(dimacres) as max_acres
from residential WHERE city='$data[1]' AND zip='$data[2]' AND county='$data[3]'and state='$data[4]' ";


$res = $conn->query($SelectQ);
if(!$res){
	echo "SelectQ Query Failed". "<br>";
	echo $SelectQ . '<br>';	
}
	

while($myDat = mysqli_fetch_array($res, MYSQLI_NUM))
	{
		
		//Insert into stats_acres
		$InsertQuery = "INSERT INTO stats_acres (`stats_geo_id`,`zip`,`city`,`county`,`state`,`average`,`lowest`,`highest`,`timestamp`,`on_market`) VALUES ('$data[0]', '$data[2]', '$data[1]', '$data[3]', '$data[4]', '$myDat[0]', '$myDat[1]', '$myDat[2]', now(), 1)";
		//echo $InsertQuery . '<br>';
		
		$resi = $conn->query($InsertQuery);

		if(!$resi){
		echo "Insert Query Failed or Record aleady present" . "<br>";
		echo $InsertQuery . '<br>';
		}
	  
	}
}
$conn->close();
echo "Finished!" . '<br> <br>' ;
?>