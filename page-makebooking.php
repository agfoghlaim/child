<?php

get_header();

$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );





// Check for form submission:
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

 
	//perform validation ensuring all form fields contain values
	//Note that password should match confirm password.

	$fn=$_POST['fname'];
	$ln=$_POST['lname'];
	$em=$_POST['email'];
	$ad=$_POST['address'];
	$country=$_POST['country'];
	$phone=$_POST['phone'];
	$postcode=$_POST['postcode'];
	$adults=$_POST['no_adults'];
	$children =$_POST['no_children'];
	$arrival=$_POST['arrival'];

	
	

	if(!empty($fn) && !empty($ln) && !empty($em))  {
	$q = "INSERT INTO guests(fname,lname, email, address, country, phone, postcode, no_adults, no_CHILDREN, arrival) 
		  VALUES ('$fn', '$ln', '$em', '$ad', '$country', '$phone', '$postcode', '$adults', '$children', '$arrival')";
	//$r = @mysqli_query ($dbc, $q);

	$r = $seconddb->query($q);
	
	
	//ebuild your insert query and run it to add the details captured on the form to the users table:
	//For example:
	//$fn=$_POST['first_name'];
	//$ln=$_POST['last_name'];
	//$un=$_POST['username'];
	//$pass1=$_POST['pass1'];
	//$q = "INSERT INTO users (firstname, lastname, username, password) VALUES ('$_POST['first_name']', '$_POST['last_name']', '$_POST['username']', SHA1('$pass1'))";		
	//$r = @mysqli_query ($dbc, $q); // Run the query. Note: $dbc is set in the mysqli_connect.php script.
	
	//Note the password is wrapped in a SHA1 function. This encrypts the password value which will be written to the database. 
	
	//check the query ran ok
	//For example:
	if ($r) {
		
		echo '<h1>Thank you!</h1>
		<p>Booking made in the db!</p><p><br /></p>';	
		
	} 

	else  { // If it did not run OK.
		echo '
		<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
		 //Debugging message:

		//echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
						
	} }
		
	 //Close the database connection - 
	//mysqli_close($dbc);
	
	// Include the footer and quit the script - exit();
		
	exit();
	

} 
?>

<h1>Book Rooms</h1>
<form action="	
<?php echo get_permalink(); ?>" method="post">
	<p>First Name: <input type="text" name="fname" size="15" maxlength="20" value="<?php if (isset($_POST['fname'])) echo $_POST['fname']; ?>" /></p>
	<p>Last Name: <input type="text" name="lname" size="15" maxlength="40" value="<?php if (isset($_POST['name'])) echo $_POST['lname']; ?>" /></p>
	<p>Email: <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>"  /> </p>
	<p>Address: <input type="text" name="address" size="20" maxlength="200" value="<?php if (isset($_POST['address'])) echo $_POST['address']; ?>"  /> </p>
	<p>Country: <input type="text" name="country" size="20" maxlength="200" value="<?php if (isset($_POST['country'])) echo $_POST['country']; ?>"  /> </p>
	<p>Eircode: <input type="text" name="postcode" size="20" maxlength="200" value="<?php if (isset($_POST['postcode'])) echo $_POST['postcode']; ?>"  /> </p>
	<p>Phone: <input type="text" name="phone" size="20" maxlength="200" value="<?php if (isset($_POST['phone'])) echo $_POST['phone']; ?>"  /> </p>
	<p>Number of Adults: <input type="number" name="no_adults" max="4" value="<?php if (isset($_POST['no_adults'])) echo $_POST['no_adults']; ?>"  /> </p>
	<p>Number of Children: <input type="number" name="no_children" max="4" value="<?php if (isset($_POST['no_children'])) echo $_POST['no_children']; ?>"  /> </p>
	<p>Arrival Time: <input type="time" name="arrival"value="<?php if (isset($_POST['arrival'])) echo $_POST['arrival']; ?>"  /> </p>
	<p><input type="submit" name="submit" value="Register" /></p>
</form>

<!-- 


