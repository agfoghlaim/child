<?php

function register_my_session()
{
  if( !session_id() )
  {
    session_start();
  }
}

add_action('init', 'register_my_session');

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}

add_theme_support( 'post-thumbnails' ); 
//add_action('wp_enqueue_script' );
add_action( 'wp_enqueue_scripts', 'divi_child_scripts');
 function divi_child_scripts(){
  wp_enqueue_script('js', get_stylesheet_directory_uri() . '/js/js.js');
  wp_enqueue_script('jquery');
 }


function seconddb(){
	global $seconddb;
	$seconddb = new wpdb('root', '', 'bandb', 'localhost');
}

add_action('init', 'seconddb');

/*add jquery ui*/






 function divi_child_moh_widget(){
 	wp_enqueue_script('js', 'http://localhost/wordpress/wp-content/plugins/moh-check-avail/js/global.js');
 	//wp_enqueue_script('global');
 }



add_action( 'wp_enqueue_scripts', 'divi_child_moh_widget');

/*start of ajax*/
add_action('wp_ajax_checkavail_m', 'check_avail');
add_action('wp_ajax_nopriv_checkavail_m', 'check_avail');

function check_avail(){
	if (isset($_POST['arrive'])){
  	$arrive = $_POST['arrive'];
  	$depart = $_POST['depart'];
    $room = $_POST['room'];

      $thequery = "SELECT DISTINCT rm_no, description, amount, post_id_wp 
           from bookings, room_type, rooms
                where bookings.rm_no = rooms.rm_id 
                and rooms.rm_type = room_type.rm_type_id
                and rm_no not in(
                  select rm_no from bookings 
                  where booking_date < '$depart'
                          AND checkout > '$arrive'
                          )AND description = '$room'";
//$sql = "SELECT rm_no from bookings";
//$myrows = $wpdb->get_results( $thequery );
$seconddb = new wpdb('root', '', 'bandb', 'localhost');
    $avail_rooms = $seconddb->get_results($thequery);
    if($avail_rooms){
      foreach($avail_rooms as $avail_room)
      {
        $post_id = $avail_room->post_id_wp;
        $queried_post = get_post($post_id);
        $title = $queried_post->post_title;
      echo " <p>  " .$title." ";
      echo $queried_post->post_content;
      echo $queried_post->post_thumbnail."</p>";
      //echo the_post_thumbnail();

		    echo "<p>". $avail_room->rm_no."</p>";
		    echo "<p>".$avail_room->description."</p>";
        //wp_die(); 
      }	
    }else{
        echo "<p>No Availabity for these dates.</p>";
      }
  }
}
//end check_avail fuction


/*end of ajax*/

/*start of moreajax*/
add_action('wp_ajax_check_the_avail', 'check_availabity');
add_action('wp_ajax_nopriv_check_the_avail', 'check_availabity');

function check_availabity(){
  if (isset($_POST['arrivalDate'])){
    $arrivalDate = $_POST['arrivalDate'];
    $departureDate = $_POST['departureDate'];

  $the_query = "SELECT DISTINCT rm_no, description, amount 
           FROM bookings, room_type, rooms
                WHERE bookings.rm_no = rooms.rm_id 
                AND rooms.rm_type = room_type.rm_type_id
                AND rm_no not IN(
                  SELECT rm_no FROM bookings 
                  AND booking_date < '$departureDate'
                  AND checkout > '$arrivalDate')";

  $available_rooms = $seconddb->get_results($the_query);

    if($available_rooms){

      foreach($available_rooms as $available_room)
      {
        echo $available_room->rm_no;
        echo $available_room->description;
      } 
    }


  }

}
?>