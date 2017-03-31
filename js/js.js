
// alert("hi");
// var form = document.getElementByID("theForm");
// form.style.visibility = "hidden";
// document.getElementByID('form-button').addEventListener('click', showForm);

// function showForm(){

// document.getElementByID("theForm").style.visibility = "hidden";
// }


// $(document).ready(function(){

// 	alert("jq");
// //     $("#booking-form").click(function(){
// //         $("theForm").hide();
// //     });
   
//  });






jQuery(document).ready(function($){
//alert("h");
//morebooking pages
  $('.form-button').on('click', showForm);
	  function showForm(){
	  	$('.booking-form').toggle();
	  }


	$('input#name-submit').on('click', function(){
		var arrive = $('#arrive').val(); alert(arrive);
		var depart = $('#depart').val();
		//var name = $('input#name').val();
		if($.trim(arrive) != ''){
			$.post(ajaxurl , {action:'checkavail_m',arrive:arrive, depart:depart }, function(data){
				$('#show-answer').html(data);
				//alert(data);
				});
		}
	});

	//moreajax.php

	// $('input#submit-dates').on('click', function(){
	// 	alert("js here");
	// 	var arrivalDate = $('input#arrivalDate').val();alert("hi");
	// 	var departureDate =$('input#departureDate').val();
	// 	$.post(ajaxUrl, {action: 'check_the_avail', arrivalDate: arrivalDate, departureDate:departureDate} function(response){
	// 		$('p#display-avail').html(response);

	// 	});
	// });

		  //calendar

		//   $('button#next-month').on('click', changeMonth);

		//   function changeMonth(){

		//   	var month = "what";
		// $.post('calendar.php', {month:month }, function(data){
		// 	//$('div#name-data').html(data);
		



		//   }
		
		
	});

