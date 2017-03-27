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
<?php echo get_permalink(); ?>" method="post">

						    <p>checkin: <input type="date" name="date" value="<?php if (isset($_POST['date'])) echo $_POST['date']; ?>"  /> </p>
						    <p>checkout: <input type="date" name="dateOut" value="<?php if (isset($_POST['dateOut'])) echo $_POST['dateOut']; ?>"  /> </p>
						    <p>room number: <input type="number" name="number" value="<?php if (isset($_POST['number'])) echo $_POST['number']; ?>"  /> </p>
						    <p><input type="submit" name="submit" value="Check Availabity" /></p>
						</form>




<?php

								try {
			
DEFINE ('DB_USER', 'root');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', 'localhost');
DEFINE ('DB_NAME', 'bandb');

// Make the connection:
$dbc = new wpdb (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' );
if($dbc){echo "what";}
// Set the encoding...



								    $rooms = array('101', '102', '103', '104');
								    $in = $_POST['date'] ;
								    echo $in;
								    $out = $_POST['dateOut'] ;
								    $sql = "SELECT IF( COUNT(1),'$rooms[0]: No','$rooms[0]: Yes' ) AS Available
								            FROM bookings
								            WHERE rm_no = '$rooms[0]' 
								            AND booking_date < '$out' 
								            AND checkout > '$in';

								            SELECT IF( COUNT(1),'$rooms[1]: No','$rooms[2]: Yes' ) AS Available
								            FROM bookings
								            WHERE rm_no = '$rooms[1]' 
								            AND booking_date < '$out' 
								            AND checkout > '$in';

								            SELECT IF( COUNT(1),'$rooms[2]: No','$rooms[2]: Yes' ) AS Available
								            FROM bookings
								            WHERE rm_no = '$rooms[2]' 
								            AND booking_date < '$out' 
								            AND checkout > '$in';

								            SELECT IF( COUNT(1),'$rooms[3]: No','$rooms[3]: Yes' ) AS Available
								            FROM bookings
								            WHERE rm_no = '$rooms[3]' 
								            AND booking_date < '$out' 
								            AND checkout > '$in';
								            ";


								} catch (Exception $e) {
								    $error = $e->getMessage();
								    echo "error";
								}
								?>




																<?php if (isset($error)) {
								    echo "<p>$error</p>";
								} else {
								     $dbc->multi_query($sql);
								     echo "querying";
								    do {
								        $result = $dbc->store_result();
								        print_r($result);
								        $row = $result->fetch_assoc();
								        echo "<h2>Room Number {$row['Available']}</h2>";
								       echo "getting";
								        $result->free();
								    } while ($dbc->next_result());
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