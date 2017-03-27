<?php

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

				<?php endif; ?>

					<div class="entry-content">
						<h1>Marie was here</h1>
						
						<!-- ==========================beginning of booking system PHP ================= -->

						<form action="	
<?php echo get_permalink(); ?>"  method="post">

						    <p>checkin: <input class="datepicker"  type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>"  /> </p>
						    <p>checkout: <input class="datepicker" type="date" name="dateOut" value="<?php if (isset($_POST['dateOut'])) echo $_POST['dateOut']; ?>"  /> </p>
						    <p>room number: <input type="number" name="number" value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>"  /> </p>
						    <p><input type="submit" name="submit" value="Check Availabity" /></p>
						</form>




<?php

							
			




								    $rooms = array('101', '102', '103', '104');
								    $in = $_POST['date'] ;
								    echo $in;
								    $out = $_POST['dateOut'] ;
								    // $sql = "SELECT DISTINCT rm_no from bookings 
								    // 		where rm_no not in(
								    // 			select rm_no from bookings 
								    // 			where booking_date < '$out'
            //                        				AND checkout > '$in')";

									 $sql = "SELECT DISTINCT rm_no, description, amount 
									 from bookings, room_type, rooms
								    		where bookings.rm_no = rooms.rm_id 
								    		and rooms.rm_type = room_type.rm_type_id
								    		and rm_no not in(
								    			select rm_no from bookings 
								    			where booking_date < '$out'
                                   				AND checkout > '$in')";
											


								
								
								




								 
								     $the_rooms = $seconddb->get_results($sql);
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
										echo "<td><button>Book Now</button></td>";
										// echo "<td>".$the_room->address."</td>";
										echo "</tr>";
										}
										echo "</table>";
																		 
								

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