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
					$_SESSION['in'] = $_POST['date'] ;
					$_SESSION['out'] = $_POST['dateOut'] ;
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
										<form action="../bookings4" 
										 method="post">
											<p><?php echo "<h3>Book room " . $the_room->rm_no . "</h3>"; ?></p>
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
									</div>
								 </td></tr>

								<?php

										// echo "<td>".$the_room->address."</td>";
										echo "</tr>";
										}
										echo "</table>";
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