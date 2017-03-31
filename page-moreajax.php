<?php
get_header();
?>
<h1>marie was here</h1>
<p>arrival: <input type="date" class="date-picker" id="arrivalDate" name="arrivalDate"></p>	
<p>departure: <input type="date" class="date-picker" id="departureDate" name="departureDate"></p>
<p><input type="submit" id="submit-dates" value="check"></p>
<p id="display-avail"></p>

<script type="text/javascript">
var ajaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>

<script>
	

	document.getElementById('submit-dates').on('click', function(){
		alert("js here");
		var arrivalDate = document.getElementById('arrivalDate').value();alert("hi");
		var departureDate =document.getElementById('departureDate').value();
		$.post(ajaxUrl, {action: 'check_the_avail', arrivalDate: arrivalDate, departureDate:departureDate} function(response){
			$('p#display-avail').html(response);

		});
	});
</script>

<?php
get_footer();
?>
