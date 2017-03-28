
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
		  $('.form-button').on('click', showForm);
		  function showForm(){
		  	$('.booking-form').toggle();
		  }
		
		
	});

