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
	  
	// datatables
		$('#datalist').DataTable({
		
			'searching'   : true,
			'ordering'    : true,
			'info'        : true,
			'responsive'  : true,
			'processing'  : true,
			'serverSide'  : true,
			"ajax": {
				"url": '<?php echo backendurl("$modul/data?category_id=$category_id")?>',
				"type": "POST"
			
			 },
			 "order": [
				[ 1, "desc" ]
			],
			
			
		});
		
	});
