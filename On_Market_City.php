<?php
/**
 * Created by PhpStorm.
 * User: Akshaya Chandrasekaran
 * Date: 3/9/2016
 */


$hn='localhost';
$db='clientopolyidx';
$un='root';
$pw='root';

// select city list from the stats_geo table
$conn = new mysqli($hn, $un, $pw, $db);
$query_city = "select id,city,zip,county,state from stats_geo";
$result_city = $conn->query($query_city);
if(!$result_city) die($conn->error);
$conn = new mysqli($hn, $un, $pw, $db);
while($data=mysqli_fetch_array($result_city, MYSQLI_NUM)) {
//insert into statistics_listings
$query = "INSERT INTO stats_listings SELECT 'id','$data[0]',zip,city,county,state,count(zip),avg(listprice),min(listprice),max(listprice),now(),'1','0' from residential where city='$data[1]' and zip='$data[2]'and status='Active'";
$result = $conn->query($query);
if(!$result) die($conn->error);
	if($result)
		echo "insert successful";

		}
    $conn->close();
