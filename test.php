<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 5/6/2016
 * Time: 12:34 AM
 */



$hn='localhost';
$db='clientopolyidx';
$un='root';
$pw='root';

// select city list from the stats_geo table
$conn = new mysqli($hn, $un, $pw, $db);
$query_city = "SELECT distinct trim(zip),trim(city),trim(county),trim(state) FROM residential order by zip";
$result_city = $conn->query($query_city);

while($data=mysqli_fetch_array($result_city, MYSQLI_NUM)) {
//insert into statistics_listings
    $query = "INSERT INTO statistics_listings SELECT 'id','$data[0]',zip,city,county,state,count(zip),avg(listprice),min(listprice),max(listprice),now(),'1','0' from residential where city='$data[1]' and zip='$data[2]'and status='Active'";
    $result = $conn->query($query);
    if(!$result) die($conn->error);
    if($result)
        echo "insert successful";
}
$conn->close();
