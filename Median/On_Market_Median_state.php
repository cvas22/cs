<?php
/**
 * Created by PhpStorm.
 * User: Akshaya Chandrasekaran, Savan Kumar Muniraju
 * Date: 6/4/2016
 */
$hn='localhost';
$db='dataservice_wfrmls';
$un='root';
$pw='root';
$conn = new mysqli($hn, $un, $pw, $db);
$query_city = "select distinct state from stats_geo";
$result_city = $conn->query($query_city);
if(!$result_city) die($conn->error);
$conn = new mysqli($hn, $un, $pw, $db);
while($data=mysqli_fetch_array($result_city, MYSQLI_NUM)) {
$query = "INSERT INTO listings_state_median 
SELECT 'id',t1.state, avg(t1.listprice) as median_val, now() FROM (
SELECT @rownum:=@rownum+1 as `row_number`, d.listprice,d.state
  FROM staging_table d,  (SELECT @rownum:=0) r
  WHERE d.state='$data[0]'
  -- put some where clause here
  ORDER BY d.listprice
) as t1, 
(
  SELECT count(*) as total_rows
  FROM staging_table d
  WHERE  d.state='$data[0]'
  -- put same where clause here
) as t2
WHERE 1
AND t1.row_number in ( floor((total_rows+1)/2), floor((total_rows+2)/2) )";


//echo $query;
$result = $conn->query($query);
if(!$result) die($conn->error);
 if($result)
  echo "insert successful";

  }
    $conn->close();
