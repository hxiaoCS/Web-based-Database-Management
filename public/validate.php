<?php

// this server side validation function has been directly put in the CRUD.php file
//
// this server side validation function has been directly put in the CRUD.php file
//
$errMessage ="";

if (isset($_POST["submit"])){


	switch ($_POST["submit"]){
		case "add":
		if (!filter_var(intval($_POST["add_cost"]), FILTER_VALIDATE_INT))
				{
					$errMessage= 'Please enter integers';
				}	
		break;

			
		case "update":
		if (!filter_var(intval($_POST["updated_cost"]), FILTER_VALIDATE_INT))
				{
					$errMessage= 'Please enter integers';
				}	
		break;
			
		default:
		break;
	}		
}
?>