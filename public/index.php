<?php

require "CRUD.php";



?>


	<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-2.1.3.min.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
	<link rel="stylesheet" href="../css/style.css">
	<title>Product Management Application</title>

	</head>

	
	<!-- list of data showing on the home page-->
	<body>
		<figure>
			<figcaption><h3>Product Database Management</h3></figcaption>
			<figcaption>
			<!--the button for adding new converage-->
				<button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#add_modal">
					<span class="glyphicon glyphicon-plus"></span> Add New
				</button>		
			</figcaption>
		<table class="table">
			<thead class="thead-light">
				<tr>
					<th scope="col">#ID</th>
					<th scope="col">Product Name</th>	
					<th scope="col">$ Cost</th>	
					<th scope="col">Edit</th>
					<th scope="col">Delete</th>
				</tr>
			</thead>
			<tbody id="tbody">
				<?php
				foreach ($result as $row){
					?>
				<form name="delete" method="post">
				<input type="hidden" name="id" value=<?php echo escape($row['id']); ?>>
					<tr>
						<td><?php echo escape($row["id"]); ?></td>
						<td><?php echo escape($row["product_name"]); ?></td>
						<td><?php echo escape($row["cost"]); ?></td>
						<td>
						<!--the button for Editing-->
							<button type="button" class="btn btn-warning" data-toggle="modal" data-target="#update_modal" title="Edit" onclick="CatchId(<?php echo escape($row["id"]); ?>)">
								<span class="glyphicon glyphicon-pencil"></span>
							</button>
							<script>
								function CatchId(id){
									document.getElementById('id').value = id;
								}
							</script>
						</td>
						<td>
						<!--the button for Deleting-->
							<button type="submit" class="btn btn-danger" name="submit" title="delete" value="delete" id="delete" onclick="return confirm('Are you sure to delete this item?');">
								<span class="glyphicon glyphicon-floppy-remove"></span>
							</button>
							
							<!--incorporating AJAX-->
							<script>
								$(document).ready(function (){
									$("#delete").click(function(){
										$(document).load('index.php');
									})
								})
							</script>
						</td>
					</tr>
				</form>
					<?php	
					} 
					?>
			</tbody>
		</table>
		</figure>

		<!--The Modal for Adding New Product
	    Reference from BootStrap Documentation: https://getbootstrap.com/docs/4.0/components/modal/
	-->
	<div class="modal fade" id="add_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Add new Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			   </div>
			   <div class="modal-body">
				<form method="post" name="add" id="add">
					<div class="form-group">
						<label for="product_name">Product Name</label>
						<select class="form-control" id="product_name" name="product_name">
							<option>Apple</option>
							<option>Orange</option>
							<option>Pear</option>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label for="add_cost">Cost</label>
						<input type="number" class="form-control" id="add_cost" name="add_cost" placeholder="only integers allowed" required>
						<?php echo "<p class='text-danger'>$errMessage</p>" ?>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary" value="add" id="add">Add</button>
					
					<!--incorporating AJAX-->
					<script>
						$(document).ready(function (){
							$("#add").click(function(){
								$(document).load('index.php');
							})
						})
					</script>
				</form>
			  </div>
			</div>
		  </div>
		</div>
	</body>
	
			<!--The Modal for updating
	    Reference from BootStrap Documentation: https://getbootstrap.com/docs/4.0/components/modal/
	-->
	<div class="modal fade" id="update_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		  <div class="modal-dialog" role="document">
			<div class="modal-content">
			  <div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update current Product</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			   </div>
			   <div class="modal-body">
				<form method="post" name="update" id="update">
					<div class="form-group">
						<label for="updated_product_name">Product Name</label>
						<select class="form-control" id="updated_product_name" name="updated_product_name">
							<option>Apple</option>
							<option>Orange</option>
							<option>Pear</option>
						</select>
					</div>
					<br>
					<div class="form-group">
						<label for="updated_cost">Cost</label>
						<input type="number" class="form-control" id="updated_cost" name="updated_cost" placeholder="only integers allowed" required>
						<?php echo "<p class='text-danger'>$errMessage</p>" ?>
					</div>
					<input type="hidden" name="id" id="id"> 
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary" value="update" id="update">Update</button>
					
				<!--incorporating AJAX-->
					<script>
						$(document).ready(function (){
							$("#update").click(function(){
								$(document).load('index.php');
							})
						})
					</script>
				</form>
			  </div>
			</div>
		  </div>
		</div>
	</body>