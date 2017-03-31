<?php
session_start();
//echo session_id();
get_header();


$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">

<?php if ( ! $is_page_builder_used ) : ?>

	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">

<?php endif; ?>

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if ( ! $is_page_builder_used ) : ?>

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
				<?php
					$thumb = '';

					$width = (int) apply_filters( 'et_pb_index_blog_image_width', 1080 );

					$height = (int) apply_filters( 'et_pb_index_blog_image_height', 675 );
					$classtext = 'et_featured_image';
					$titletext = get_the_title();
					$thumbnail = get_thumbnail( $width, $height, $classtext, $titletext, $titletext, false, 'Blogimage' );
					$thumb = $thumbnail["thumb"];

					if ( 'on' === et_get_option( 'divi_page_thumbnails', 'false' ) && '' !== $thumb )
						print_thumbnail( $thumb, $thumbnail["use_timthumb"], $titletext, $width, $height );
				?>

				<?php endif;  ?>
				

					<div class="entry-content">
						
						
						<!-- ==========================beginning of booking system PHP ================= -->

						<form action="<?php echo get_permalink(); ?>"  method="post">
							<p>checkin: <input class="datepicker"  type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>"  /> </p>
						    <p>checkout: <input class="datepicker" type="date" name="dateOut" value="<?php if (isset($_POST['dateOut'])) echo $_POST['dateOut']; ?>"  /> </p>
						   <!--  <p>room number: <input type="number" name="number" value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>"  /> </p> -->
						    <p><input type="submit" name="submit" value="Check Availabity" /></p>
						</form>




				<?php

				if (isset($_POST['submit'])){
					$_SESSION['in'] = $_POST['date'] ;
					$_SESSION['out'] = $_POST['dateOut'] ;
				}

					$rooms = array('101', '102', '103', '104');
				    $in = $_SESSION['in'] ;
				
				    $out = $_SESSION['out'] ;
				
				  
				
					var_dump($_SESSION);
					echo  $_SESSION['in'];
					echo  $_SESSION['out'];
					$sql = "SELECT DISTINCT rm_no, description, amount 
					 from bookings, room_type, rooms
				    		where bookings.rm_no = rooms.rm_id 
				    		and rooms.rm_type = room_type.rm_type_id
				    		and rm_no not in(
				    			select rm_no from bookings 
				    			where booking_date < '$out'
                   				AND checkout > '$in')";
							

					$the_rooms = $seconddb->get_results($sql);
					if($the_rooms){
								     echo "<pre>";
								     print_r($the_rooms);
								     echo "</pre>";

								     echo "<table>";
								     	echo "<tr><td>Available Rooms</td>";
								     	echo "<td>Room Type</td>";
								     	echo "<td>Nightly Rate</td>";
								     	echo "<td></td></tr>";
										foreach($the_rooms as $the_room){
										echo "<tr>";
										echo "<td>".$the_room->rm_no."</td>";
										echo "<td>".$the_room->description."</td>";
										echo "<td>".$the_room->amount."</td>";
										echo "<td><input type='submit' class='form-button' value='book now' ></td>";
										//exit();

										?>
										
										<tr><td><?php echo "<h3>" . $the_room->rm_no . "</h3>"; ?>
											<div class="booking-form" style="display:none;">form goes here
												<h1>Book Rooms</h1>
												<form action="<?php echo get_permalink(); ?>" id="theForm"
												 method="post">
													<p><?php echo "<h3>Book room " . $the_room->rm_no . "</h3>"; ?></p>
													<p><input type="hidden" name ="roomNo" value="<?php echo $the_room->rm_no; ?>"></p>
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
													<p><input type="submit" name="submitInfo"  value="Register" /></p>
												</form>
											</div>
										 </td></tr>

										<?php
										// echo "<td>".$the_room->address."</td>";
										echo "</tr>";
										}
										echo "</table>";



				 					if (isset($_POST['submitInfo'])){
				 	$_SESSION['room'] = $_POST['roomNo'] ;
				 	echo "<h1>SESSION[room] is : " . $_SESSION['room'] . "</h1>";
				 	echo "<h1>post[room] is : " . $_POST['roomNo'] . "</h1>";
					
				 }
									$roomNo = $_POST['roomNo'];
									echo $roomNo."zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz";
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
					}
					echo "<h1>this is the relevent room no: " .$roomNo . "</h1>";

					if(isset($_SESSION['in'])){
    $in = $_SESSION['in'];
    $out = $_SESSION['out'];
}
				
					if(!empty($fn) && !empty($ln) && !empty($em))  {
						
						$q = "INSERT INTO guests(fname,lname, email, address, country, phone, postcode, no_adults, no_CHILDREN, arrival) 
							  VALUES ('$fn', '$ln', '$em', '$ad', '$country', '$phone', '$postcode', '$adults', '$children', '$arrival')";
							  	printf ("New Record has id %d.\n", $seconddb->insert_id);
						//$last = "SELECT LAST_INSERT_ID();";

				     print_r($q);

				
					
						
						//$lastid = $seconddb->last_insert_id;

						
					//$x = "SELECT mysql_insert_id('$book')";
				
					$r = $seconddb->query($q);
			
						if ($r) {
						//printf ("New Record has id %d.\n", $seconddb->insert_id);	
							echo '<h1>Thank you!</h1>
							<p>Guest in the db!</p><p><br /></p>';	
							$guest = $seconddb->insert_id;

							var_dump($_SESSION);
							echo "<h1>This is marie variable " . $guest . "</h1>";
							echo "<h1>" . $_SESSION['in'] . "</h1>";
							echo "<h1>This is in variable " . $in . "</h1>";
							echo "<h1>This is out variable " . $out . "</h1>";
								echo  $_SESSION['in'];
					echo  $_SESSION['out'];
					var_dump($_SESSION);
							//insert booking 
							//$book_query = "INSERT INTO bookings(guestID,booking_date, checkout)
    						//VALUES('$guest','$in', '$out'); ";
    						$book_query = "INSERT INTO bookings(guestID,booking_date, checkout, rm_no)
    						VALUES('$guest','$in', '$out', '$roomNo'); ";
    						$booking = $seconddb->query($book_query);
    						 //echo "<pre>";
				     //print_r($booking);
				     //echo "</pre>";
    						if($booking){
    							echo "i think it worked";
    						}else {echo "booking didn't work";}

						} 

						else  { // If it did not run OK.
							echo '
							<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
						}
						// if($booking){
						// 	echo "ok";
						// }else{echo "no to booking";}		
					} 
	

				?>


					
				<!-- ============================end of booking system PHP ====================== -->






					<?php
						the_content();

						if ( ! $is_page_builder_used )
							wp_link_pages( array( 'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'Divi' ), 'after' => '</div>' ) );
					?>
					</div> <!-- .entry-content -->

				<?php
					if ( ! $is_page_builder_used && comments_open() && 'on' === et_get_option( 'divi_show_pagescomments', 'false' ) ) comments_template( '', true );
				?>

				</article> <!-- .et_pb_post -->

			<?php endwhile; ?>

<?php if ( ! $is_page_builder_used ) : ?>

			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->

<?php endif; ?>

</div> <!-- #main-content -->

<?php get_footer(); ?>