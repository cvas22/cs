<?php
/**
 * Created by PhpStorm.
 * User: Akshaya Chandrasekaran
 * Date: 5/28/2016
 */


$hn='localhost';
$db='dataservice_wfrmls';
$un='root';
$pw='root';
$conn = new mysqli($hn, $un, $pw, $db);
$query_city = "select id,city,zip,county,state from stats_geo";
$result_city = $conn->query($query_city);
if(!$result_city) die($conn->error);
$conn = new mysqli($hn, $un, $pw, $db);
while($data=mysqli_fetch_array($result_city, MYSQLI_NUM)) {
//insert into staging_table
//echo $data[0]; 
//echo $data[1]; 
//echo $data[2]; 
//echo $data[3];
//echo $data[4];  
//echo '$result_city[0]';
$query = "INSERT INTO staging_table SELECT distinct 'id','$data[0]','$data[1]','$data[2]','$data[3]','$data[4]',listprice,now() from residential where zip='$data[2]' and city='$data[1]' and county='$data[3]' and state='$data[4]'";
//echo $query;
$result = $conn->query($query);
if(!$result) die($conn->error);
 if($result)
  echo "insert successful";

  }
    $conn->close();
