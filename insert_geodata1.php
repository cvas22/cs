<?php
/**
 * Created by PhpStorm.
 * User: Savan Kumar
 * Date: 1/8/2016
 * Time: 4:01 PM
 */


$hn='localhost';
$db='clientopolyidx';
$un='root';
$pw='root';

// select zip list from the geo_data table
$query_zip = "SELECT distinct trim(zip),trim(city),trim(county),trim(state) FROM residential order by zip";
$conn = new mysqli($hn, $un, $pw, $db);
$result_geo = $conn->query($query_zip);
$count =0;
while($geo=mysqli_fetch_array($result_geo, MYSQLI_NUM)) {
$query_count = "SELECT count(1) FROM stats_geo where zip='$geo[0]' and city ='$geo[1]' and county ='$geo[2]' and state ='$geo[3]'";
$result_count = $conn->query($query_count);
$count = mysqli_fetch_array($result_count);

if (!$count[0]>0){
$query_insert = "INSERT INTO stats_geo (zip,city,county,state) values ('$geo[0]','$geo[1]','$geo[2]','$geo[3]')";
	$conn->query($query_insert);
    echo "New record created successfully";
} else {
    echo "Error:" ."already present" . "<br>" . $conn->error;
}	
		
		}
		
    $conn->close();


?>