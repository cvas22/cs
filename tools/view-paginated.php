<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>View Records</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/15/2016
 * Time: 1:54 AM
 *
 * This php script is used to display and edit the data
 * in the user table.
 */

	// connect to the database
	include('connect.php');
	
	// number of results to show per page
	$per_page = 10;
	
	// figure out the total pages in the database
	$result = $conn->query("SELECT * FROM stats_geo");
	$total_results = $result->num_rows;
	$total_pages = ceil($total_results / $per_page);

	// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
	if (isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$show_page = $_GET['page'];
		
		// make sure the $show_page value is valid
		if ($show_page > 0 && $show_page <= $total_pages)
		{
			$start = ($show_page -1) * $per_page;
			$end = $start + $per_page; 
		}
		else
		{
			// error - show first set of results
			$start = 0;
			$end = $per_page; 
		}		
	}
	else
	{
		// if page isn't set, show first set of results
		$start = 0;
		$end = $per_page; 
	}
	
	// display pagination
	
	//echo "<p><a href='view.php'>View All</a> | <b>View Page:</b> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='view-paginated.php?page=$i'>$i</a> ";
	}
	echo "</p>";
		
	// display data in table
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>id</th> <th>Zip</th> <th>City</th> <th>County</th> <th>State</th> <th>Date_started</th></tr>";

	// loop through results of database query, displaying them in the table	
	//for ($i = $start; $i < $end; $i++)
	//{
		
		echo '$i' . "<br>";
		echo $total_results . "<br>";
		// make sure that PHP doesn't try to show results that don't exist
		//if ($i == $total_results) { break; }
	
		// echo out the contents of each row into a table
		$i = $start;
		echo "Start" . $start;
		echo "End" . $end;
		
		while($row = mysql_fetch_array($result)) 
		{
			echo $index.' '.$row['whatever'];
		$index++;
		}
}
		foreach ($result as $result)
		{		
			if ($i == $total_results || $i >= $end) { break; }
			echo "<tr>";
			echo '<td>' . $result['id']. '</td>';	
			echo '<td>' . $result['zip'] . '</td>';
			echo '<td>' . $result['city']. '</td>';
			echo '<td>' . $result['county'] . '</td>';
			echo '<td>' . $result['state'] . '</td>';
			echo '<td>' . $result['date_started'] . '</td>';
			echo '<td><a href="edit.php?id=' . $result['id'] . '">Edit</a></td>';
			echo '<td><a href="delete.php?id=' . $result['id'] . '">Delete</a></td>';
			echo "</tr>";
			$i = $i + 1;
		}
	//}
echo "</table>";
	
	// pagination
	
?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html>