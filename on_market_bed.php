<?php
/**
* Created by PhpStorm.
* User: Srinivas
* Date: 3/15/2016
* Time: 1:57 AM
*
* This script generates average, high, and low values for each bedroom type
*/

// Connect to the database
include "tools/connect.php";


echo "PHP Scripted started... Please wait" . '<br> <br>' ;
//Get city list from the stats_geo table
$SQLQuery = "SELECT id, city, zip, county, state FROM stats_geo";
$result_city = $conn->query($SQLQuery);

while($data=mysqli_fetch_array($result_city, MYSQLI_NUM)) 
{

//For each result in city, county, zip, fetch the average, min, max values of list price
$SelectQ = "SELECT totbed, ceil(avg(listprice)), min(listprice), max(listprice) from residential where city='$data[1]' AND zip='$data[2]' AND county='$data[3]' AND status='Active' GROUP BY totbed";

//echo $SelectQ . '<br>';
$res = $conn->query($SelectQ);
if(!$res)
	echo "SelectQ Query Failed". "<br>";

while($myDat = mysqli_fetch_array($res, MYSQLI_NUM))
	{
		
		//Insert into stats_bed
		$InsertQuery = "INSERT INTO stats_bed (`stats_geo_id`,`zip`,`city`,`county`,`state`,`bed_count`,`average`,`lowest`,`highest`,`timestamp`,`on_market`) VALUES ('$data[0]', '$data[2]', '$data[1]', '$data[3]', '$data[4]', '$myDat[0]', '$myDat[1]', '$myDat[2]', '$myDat[3]', now(), 1)";
		//echo $InsertQuery . '<br>';
		
		$resi = $conn->query($InsertQuery);

		if(!$resi)
			echo "Insert Query Failed or Record aleady present" . "<br>";
	  
	}
}
$conn->close();
echo "Finished!" . '<br> <br>' ;
?>