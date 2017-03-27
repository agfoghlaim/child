

<?php
								try {
								    require_once 'connect.php';
								    $rooms = array('101', '102', '103', '104');
								    $in = $_POST['date'] ;
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
								}
								?>




																<?php if (isset($error)) {
								    echo "<p>$error</p>";
								} else {
								     $dbc->multi_query($sql);
								    do {
								        $result = $dbc->store_result();
								        $row = $result->fetch_assoc();
								        echo "<h2>Room Number {$row['Available']}</h2>";
								       
								        $result->free();
								    } while ($dbc->next_result());
								}
								$dbc->close();
								?>

