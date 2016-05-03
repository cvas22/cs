<html>





<h4>
<?php echo "LIST OF USERS";?>
</h4>
<?php


// connect to the database
include('connect.php');
$SQLquery = "SELECT * FROM stats_geo";
$result = $conn->query($SQLquery);

// display data in table
//echo "<p><b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
echo "<table border='1' cellpadding='10'>";
echo "<tr> <th>id</th> <th>Username</th> <th>Email</th> <th>Password</th> <th>Phone</th> <th>Date Started</th></tr>";

// loop through results of database query, displaying them in the table
while($row = mysqli_fetch_array($result)) {
// echo out the contents of each row into a table

echo "<tr>";
echo '<td>' . $row['id'] . '</td>';
echo '<td>' . $row['zip'] . '</td>';
echo '<td>' . $row['city'] . '</td>';
echo '<td>' . $row['county'] . '</td>';
echo '<td>' . $row['state'] . '</td>';
echo '<td>' . $row['date_started'] . '</td>';
echo '<td><a href="edit.php?id=' . $row['id'] . '">Edit</a></td>';
echo '<td><a href="delete.php?id=' . $row['id'] . '">Delete</a></td>';
echo "</tr>";
}
echo "</table>";
?>
<!--<p><a href="new.php">Add a new record</a></p> -->

</body>
</html>
