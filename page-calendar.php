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
						
						<div> <!--div for calendar -->

						
						<!-- ==========================calendar================= -->

						<?php 
						echo "<h1>marie was here</h1>";

			

$date = time();
//$date = strtotime("+1 month");
$day = date('d', $date);
$month = date('m', $date);
$year = date('Y', $date);

$first_day = mktime(0,0,0,$month, 1, $year);
$title = date('F', $first_day);
$day_of_week = date('D', $first_day);

switch($day_of_week){
	case "Sun": $blank = 0; break;
	case "Mon": $blank = 1; break;
	case "Tues": $blank = 2; break;
	case "Wed": $blank = 3; break;
	case "Thurs": $blank = 4; break;
	case "Fri": $blank = 5; break;
	case "Sat": $blank = 6; break;

}


	
$getnext = $date; 
$getnext = strtotime("+1 month");
// $getnextmonth= strtotime("+1 month");
$nextmonth = date('F', $getnext); 

$days_in_month = cal_days_in_month(0, $month, $year);
echo "<button id='next-month'>".$nextmonth."</button>";
echo "<table class='myCal'>";
echo "<tr><th colspan=60>" . $title . $year . "</th>";
echo "<tr><td>S</td><td>M</td><td>T</td>
<td>W</td><td>T</td><td>F</td>
<td>S</td></tr>";

$day_count = 1;

echo "<tr>";

while( $blank >0){
	echo "<td></td>";
	$blank = $blank-1;
	$day_count++;
}

$day_num = 01;

/* start of queries*/

/* end of queries*/

while($day_num <= $days_in_month){
$dateIn = $year."-".$month."-".str_pad($day_num, 2, "0", STR_PAD_LEFT);
$dateOut = $year."-".$month."-".str_pad($day_num+1, 2, "0", STR_PAD_LEFT);

//echo "<h1> this is date in".$dateIn."</h1>";
//echo "<h1> this is date out".$dateOut."</h1>";
	//find avaibility for each day
	//echo $avail.$day_num
	$check_avail = "SELECT DISTINCT rm_no, description, amount 
                 from bookings, room_type, rooms
                where bookings.rm_no = rooms.rm_id 
                and rooms.rm_type = room_type.rm_type_id
                and rm_no not in(
                    select rm_no from bookings 
                    where booking_date < '$dateOut'
                    AND checkout > '$dateIn')";
//echo $year.$month.$day_num+1;
//echo $year-$month-$day_num;
//echo "<p> this is date in".$dateIn."</p>";
//echo "<p> this is date out".$dateOut."</p>";
$avail = $seconddb->get_results($check_avail);
if($avail){
	//echo "<h1>hiya</h1>";
	
}

	echo "<td>" . $day_num  ."<br>";
foreach($avail as $available){
	echo $available->rm_no ."<br>";	
	}
	 
	echo "</td>";
	$day_num++;
	$day_count++;

	if($day_count >7){
		echo "</tr><tr>";
		$day_count = 1;
	}
}

while($day_count > 1 && $day_count <=7){
	$day_count++;
}

echo "</tr></table>";


?>


					</div><!--end div for calendar-->
									
						<!-- ==========================end calendar================= -->



				
					</div> <!-- .entry-content -->


			




			</div> <!-- #left-area -->

			<?php get_sidebar(); ?>
		</div> <!-- #content-area -->
	</div> <!-- .container -->



</div> <!-- #main-content -->

<?php get_footer(); ?>