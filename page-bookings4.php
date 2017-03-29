<?php
session_start();
var_dump($_SESSION);
echo session_id();
get_header();


//$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">



	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">


	

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
			
				

					<div class="entry-content">
						
						
						<!-- ==========================beginning of booking system PHP ================= -->



<?php

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
							  	printf ("New Record has id %d.\n", $seconddb->insert_id);
			

				     print_r($q);
					$r = $seconddb->query($q);
					
						if ($r) {
						//printf ("New Record has id %d.\n", $seconddb->insert_id);	
							echo '<h1>Thank you!</h1>
							<p>Guest in the db!</p><p><br /></p>';	
							$marie = $seconddb->insert_id;

							var_dump($_SESSION);
							echo "<h1>This is marie variable " . $marie . "</h1>";
							echo "<h1>" . $_SESSION['in'] . "</h1>";
							echo "<h1>This is in variable " . $in . "</h1>";
							echo "<h1>This is out variable " . $out . "</h1>";
								if(isset($_SESSION['in'])){
								    $dateIn = $_SESSION['in'];
								    $dateOut = $_SESSION['out'];
								}else{
									echo  $_SESSION['in'];
									echo  $_SESSION['out'];
									var_dump($_SESSION);
								}

						
							//insert booking 
							$book_query = "INSERT INTO bookings(guestID,booking_date, checkout)
    						VALUES('$marie','$dateIn', '$dateOut'); ";
    						$booking = $seconddb->query($book_query);
    				
    						if($booking){
    							echo "i think it worked";
    						}else {echo "booking didn't work";}

						} 

						else  { // If it did not run OK.
							echo '
							<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
						}
						
					} 
	

				?>


				
					
				<!-- ============================end of booking system PHP ====================== -->






				
					</div> <!-- .entry-content -->


			




			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->



</div> <!-- #main-content -->

<?php get_footer(); ?>