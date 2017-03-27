<?php
 //connect to the database 	
	require('connect.php');

/*
	$fn=$_POST['first_name'];
	$ln=$_POST['last_name'];
	$un=$_POST['email'];
	*/
	



	if(!empty($_POST['first_name']) && !empty($_POST['last_name']) && !empty($_POST['email']) ){

	$q = "INSERT INTO guests (fname, lname, email)
		VALUES ('".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."')";
	$s =  "INSERT INTO guests (fname, lname, email)
		VALUES ('".$_POST['first_name']."','".$_POST['last_name']."','".$_POST['email']."')";
	$r = @mysqli_query($dbc, $q);
	
if ($r) {
		
		echo '<h1>Thank you!</h1>
		<p>You are now registered as a guest</p><p><br /></p>';	
		
	} 

	else  { // If it did not run OK.
		echo '<h1>Everything is not okay</h1>';
		
						
	}}

	$sql = "SELECT booking_date FROM bookings";
$result = $dbc->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "availabity: " . $row["booking_date"]. "<br>";
    }
} else {
    echo "0 results";
}
		
	 //Close the database connection - 
	mysqli_close($dbc);
	
	// Include the footer and quit the script - exit();
		
	exit();
	



?>