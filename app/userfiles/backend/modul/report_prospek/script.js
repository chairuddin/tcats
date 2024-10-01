//https://jqueryvalidation.org/documentation/
/*
required – Makes the element required.
remote – Requests a resource to check the element for validity.
minlength – Makes the element require a given minimum length.
maxlength – Makes the element require a given maximum length.
rangelength – Makes the element require a given value range.
min – Makes the element require a given minimum.
max – Makes the element require a given maximum.
range – Makes the element require a given value range.
step – Makes the element require a given step.
email – Makes the element require a valid email
url – Makes the element require a valid url
date – Makes the element require a date.
dateISO – Makes the element require an ISO date.
number – Makes the element require a decimal number.
digits – Makes the element require digits only.
equalTo – Requires the element to be the same as another one



accept – Makes a file upload accept only specified mime-types.
creditcard – Makes the element require a credit card number.
extension – Makes the element require a certain file extension.
phoneUS – Validate for valid US phone number.
require_from_group – Ensures a given number of fields in a group are complete.
* 
*  
 */
 
  
  
 
$(document).ready(function(){
	  $('input[name="tanggal"]').daterangepicker({
		singleDatePicker: true,
		showDropdowns: true,
		minYear: 1991,
		maxYear: parseInt(moment().format('YYYY'),10),
		locale: {
			format: 'DD/MM/YYYY'
		}
	  }, function(start, end, label) {
		//var years = moment().diff(start, 'years');
		//alert("You are " + years + " years old!");
	  });
	
});


function change_filter() {
	var selectElement = document.getElementById('filter');
	var selectedValue = selectElement.value;
	url='<?php echo backendurl("report_prospek/change_filter/");?>'+selectedValue;
	var content=fetch_filter(url);
}

function fetch_filter(url) {
	$.ajax({
		url: url, // Replace with your API endpoint
		method: 'GET',
		success: function(response) {
			var content = $(response).filter('select'); // Adjust according to your HTML structure
			$('#filter2').html(response);

			// Extract and execute scripts
			var scripts = $(response).filter('script');
			scripts.each(function() {
				$.globalEval(this.text || this.textContent || this.innerHTML || '');
			});
		},
		error: function(xhr, status, error) {
			console.error('Error loading content:', status, error);
		}
	});
	
}