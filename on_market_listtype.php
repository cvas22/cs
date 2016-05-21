<?php
/**
* Created by PhpStorm.
* User: Srinivas
* Date: 3/15/2016
* Time: 1:57 AM
* This script generates total listing, total new listing, total off market per list category and list type
*/

// Connect to the database
include "tools/connect.php";


echo "PHP Scripted started... Please wait" . '<br> <br>' ;
//Get city list from the stats_geo table
$SQLQuery = "SELECT distinct listtype, proptype FROM residential";
	
$results = $conn->query($SQLQuery);

while($data=mysqli_fetch_array($results, MYSQLI_NUM)) 
{


	/*
	Select total listings
	*/

	$SelectQ = "SELECT count(*) AS total_listing FROM residential WHERE listtype ='$data[0]' AND proptype='$data[1]'";
	//echo $SelectQ . '<br>';
	$res_total = $conn->query($SelectQ);
	if(!$res_total){
		echo "SelectQ Query Failed". "<br>";
		echo $SelectQ . '<br>';
		$res_total = 0;	
	}
	
	if($row = $res_total->fetch_assoc())
	{
		$res_total = $row['total_listing'];
		//echo $res_total . '<br>';
	}
	
	
	/*
	Total off market
	*/
	$SelectQ = "SELECT count(*) AS total_off_market FROM residential WHERE status != 'Active' AND listtype ='$data[0]' AND proptype='$data[1]';";

	//echo $SelectQ . '<br>';

	$res_total_off = $conn->query($SelectQ);
	if(!$res_total_off){
	echo "SelectQ Query Failed". "<br>";
	echo $SelectQ . '<br>';
	$res_total_off= 0;
	}
	
	if($row = $res_total_off->fetch_assoc())
	{
		$res_total_off = $row['total_off_market'];
		//echo $res_total_off . '<br>';
	}
	

	/*
	Select total new listings (new listing is defined as a listing within 24 hours)
	*/

	$SelectQ ="SELECT count(*) AS total_new_listing
	FROM
	( 
		SELECT timestampdiff (hour, TIMESTAMP(new_listing_timestamp), TIMESTAMP(now())) AS diff 
		FROM residential WHERE listtype ='$data[0]' AND proptype='$data[1]'
	) col	
	WHERE col.diff <= 24;";


	//echo $SelectQ . '<br>';
	$res_total_new = $conn->query($SelectQ);

	if(!$res_total_new){
		echo "SelectQ Query Failed". "<br>";
		echo $SelectQ . '<br>';
		$res_total_new = 0;
	}
	
	
	if($row = $res_total_new->fetch_assoc())
	{
		$res_total_new = $row['total_new_listing'];
		//echo $res_total_off . '<br>';
	}
	
	$insertQ ="INSERT INTO stats_list
	(
	`listtype`,
	`proptype`,
	`total`,
	`total_new`,
	`total_off_market`,
	`timestamp`,
	`on_market`
	)
	
	VALUES
		(
		'$data[0]',
		'$data[1]',
		'$res_total',
		'$res_total_new',
		'$res_total_off',
		now(),
		'1'
		);";
		
	$res = $conn->query($insertQ);

	if(!$res){
		echo "Insert Query Failed". "<br>";
		echo $insertQ . '<br>';	
	}
}

$conn->close();
echo "Finished!" . "<br> <br>" ;
?>