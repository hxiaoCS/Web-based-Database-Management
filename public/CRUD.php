<?php

try{
	require "../config.php";
	require "../common.php";
	
	$errMessage ="";
	
	$connection = new PDO($dsn);
	$connection->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
			
	
	function Add(){
		global $connection;
		
		if ($_POST["product_name"] && $_POST["add_cost"])
		{		
	

			$sql = "INSERT INTO product(product_name, cost) VALUES (:product_name, :cost)";
			
			$statement = $connection->prepare ( $sql );
			$statement->bindParam (':product_name', $_POST['product_name']);
			$statement->bindParam(':cost', intval($_POST['add_cost']));
			$statement->execute();	
		}
	}
	
	
	function Delete(){
		
		global $connection;
		
		if ($_POST["id"])
		{		
			$sql = "DELETE FROM product WHERE id = :id";
			
			$statement =$connection->prepare ($sql);
			$statement->bindParam (':id', $_POST['id']);
			$statement->execute();	
		}
	}
	
	function Update(){
		
		global $connection;
		
		if ($_POST["updated_product_name"] && $_POST["updated_cost"] && $_POST["id"]){
			
			$sql = "UPDATE product SET product_name=:product_name, cost=:cost WHERE id = :id";
			
			$statement = $connection->prepare($sql);
			$statement->bindParam(':id', $_POST['id']);
			$statement->bindParam(':product_name', $_POST['updated_product_name']);
			$statement->bindParam(':cost', intval($_POST['updated_cost']));
			$statement->execute();	
		}

	}
	
	if (isset($_POST["submit"])){ 
	
		switch ($_POST["submit"]){
			case "add":
			//server side validation
			if (filter_var(intval($_POST["add_cost"]), FILTER_VALIDATE_INT))
				{
					Add();
				}	
			else { $errMessage= 'Please enter integers'; }
			break;

			case "delete":
			Delete();
			break;
	
			
			case "update":
			//server side validation
			if (filter_var(intval($_POST["updated_cost"]), FILTER_VALIDATE_INT))
				{
					Update();
				}	
			else { $errMessage= 'Please enter integers'; }
			break;
			
			default:
			break;
		}	
	}
	
	$sql = "SELECT * FROM product ORDER BY id";

	$statement = $connection->prepare($sql);
	$statement->execute();

	$result = $statement->fetchAll (PDO::FETCH_ASSOC);

}
catch  (PDOException $error){
	echo "Error+++";
}

?>