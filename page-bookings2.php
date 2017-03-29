<?php
session_start();
//var_dump($_SESSION);
echo session_id();
get_header();
include "connect.php";


//$is_page_builder_used = et_pb_is_pagebuilder_used( get_the_ID() );

?>

<div id="main-content">



	<div class="container">
		<div id="content-area" class="clearfix">
			<div id="left-area">


	

					<h1 class="entry-title main_title"><?php the_title(); ?></h1>
			
				

					<div class="entry-content">
						
						
						<!-- ==========================beginning of booking system PHP ================= -->

						<!--<form action="../bookings3"  method="post">-->
							<form action="<?php echo get_permalink(); ?>"  method="post">
							<p>checkin: <input class="datepicker"  type="date" name="date"   /> </p>
						    <p>checkout: <input class="datepicker" type="date" name="dateOut" /> </p>
						
						    <p><input type="submit" name="submit"  value="Check Availabity" /></p>
						</form>






					
				<!-- ============================booking system PHP ====================== -->
				//<?php 

					if(isset($_POST['submit'] )){

					$_SESSION['in'] = $_POST['date'];
					$_SESSION['out'] = $_POST['dateOut'];

					if(isset($_SESSION['in'])){
  
					$in = $_SESSION['in'];
					$out = $_SESSION['out'];
					echo $_SESSION['in'];
					echo $_SESSION['out'];
					echo $in;
					echo $out;
					}  	
					

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
						echo "<p>".$the_room->rm_no."</p>";
						echo "<p>".$the_room->description."</p>";
						echo "<p>".$the_room->amount."</p>";
					}}
						//echo "<p>f</p>";
				?>

				<!-- ============================end of booking system PHP ====================== -->




				
					</div> <!-- .entry-content -->


				</article> <!-- .et_pb_post -->




			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->



</div> <!-- #main-content -->

<?php get_footer(); ?>