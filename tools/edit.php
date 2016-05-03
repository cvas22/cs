<?php
/**
 * Created by PhpStorm.
 * User: Srinivas
 * Date: 3/15/2016
 * Time: 11:28 AM
 *
 * Editor for the user column
 * Allows user to edit specific user entry in database
*/

 // creates the edit record form
 function createForm($id, $zip, $city, $county, $state, $date_started, $error)
 {
     // if there are any errors, display them
     if ($error != '')
     {
         echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
     }
     ?>
     <form action="" method="post">
         <input type="hidden" name="id" value="<?php echo $id; ?>"/>
         <div>
            <table>
                <tr><strong><td align="right">Userid:</strong></td> <td align="left"><?php echo $id; ?></td></tr>
                <tr><strong><td align="right">Zip:</strong></td> <td align="left"><input type="text" align="left" name="zip" value="<?php echo $zip; ?>"/></td></tr><br/>
                <tr><strong><td align="right">City:</strong></td> <td align="left"><input type="text" align="left" name="city" value="<?php echo $city; ?>"/></td></tr><br/>
                <tr><strong><td align="right">County:</strong></td> <td align="left"><input type="text" align="left" name="county" value="<?php echo $county; ?>"/></td></tr><br/>
				<tr><strong><td align="right">State:</strong></td> <td align="left"><input type="text" align="left" name="state" value="<?php echo $state; ?>"/></td></tr><br/>
                <tr><strong><td align="right">Date Started:</strong></td> <td align="left"><input type="text" align="left" name="date_started" value="<?php echo $date_started; ?>"/></td></tr><br/>
            </table>
                <input type="submit" name="submit" value="Submit">

         </div>
     </form>
	 </body>
     </html>
     <?php
 }


 // connect to the database
 include('connect.php');

 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 {
     // confirm that the 'id' value is a valid integer before getting the form data
     if (is_numeric($_POST['id']))
     {
         // get form data, making sure it is valid
         $id = $_POST['id'];
         $zip = mysqli_real_escape_string($conn, htmlspecialchars($_POST['zip']));
         $city = mysqli_real_escape_string($conn,htmlspecialchars($_POST['city']));
         $county = mysqli_real_escape_string($conn,htmlspecialchars($_POST['county']));
         $state = mysqli_real_escape_string($conn,htmlspecialchars($_POST['state']));
		 $date_started = mysqli_real_escape_string($conn,htmlspecialchars($_POST['date_started']));
         // check that firstname/lastname fields are both filled in
         if ($zip == '' || $city == '' || $county == '' || $state == '' || $date_started == '')
         {
             // generate error message
             $error = 'Please fill in all required fields!';
             //error, re-display display form
             createForm($id, $zip, $city, $county, $state, $date_started, '');
         }
         else
         {
             // save the data to the database
             $SQLQuery = "UPDATE stats_geo SET zip='$zip', city='$city', county='$county', state='$state' , date_started = $date_started WHERE id='$id' ";
             $result = $conn->query($SQLQuery);
             if(!$result)
             {
                 echo $SQLQuery;
                 echo "<br> Query execution failed! Please check input parameters";
             }
             // once saved, redirect back to the view page
             header("Location: admin.php");
         }
     }
     else
     {
         // if the 'id' isn't valid, display an error
         echo 'Invalid id! POST';
         echo $_POST['id'];
     }
 }
 else
     // if the form hasn't been submitted, get the data from the db and display the form
 {
     // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
     if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
     {
         // query db
         $id = $_GET['id'];
         $result = $conn->query("SELECT * FROM stats_geo WHERE id=$id");
         $row = mysqli_fetch_array($result);

         // check that the 'id' matches up with a row in the databse
         if($row)
         {
            // get data from db
             $zip = $row['zip'];
             $city = $row['city'];
             $county = $row['county'];
			 $state = $row['state'];
             $date_started = $row['date_started'];
             $error = '';
             // show form
             createForm($id, $zip, $city, $county, $state, $date_started, $error);
         }
         else
             // if no match, display result
         {
             echo "No results for that id";
         }
     }
     else
         // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
     {
         echo "Invalid id! GET!";
     }
 }
?>