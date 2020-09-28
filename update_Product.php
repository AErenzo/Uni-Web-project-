<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Stock Managment Console</title>

    <!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

	<!-- jQuery library -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<!-- Latest compiled JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
  
  <?php
		  require ("db_connet.php");
		  
		  $connection = mysqli_connect($host, $username, $password, $db);
		  
		  if (mysqli_connect_error())
		  {
			  echo "Failed to connect to MYSQL: " . mysqli_connect_error();
		  }
		  
		 
		 
		if (!empty($_GET["id"])) {  
		
			$id = $_GET['id'];
			
			if (isset($_POST["updateSubmit"])) { // If update form submitted
				// Check all parts of the form have a value
				
				$category = ($_POST["category"]);
				$type = ($_POST["type"]);
				$productName = ($_POST["productname"]);
				$colour = ($_POST["colour"]);
				$brand = ($_POST["brand"]);
				$gender = ($_POST["gender"]);
				$measurement = ($_POST["measurement"]);
				$costPrice = ($_POST["costprice"]);
				$sellPrice = ($_POST["sellprice"]);
				$stockLevel = ($_POST["stocklevel"]);
				
			
				if ((!empty($id)) && (!empty($category)) && (!empty($type)) 
					&& (!empty($productName)) && (!empty($colour)) 
					&& (!empty($brand)) && (!empty($gender))
					&& (!empty($measurement)) && (!empty($costPrice))
					&& (!empty($sellPrice)) && (!empty($stockLevel))){
				
					
					// Create and run update query to update product details
					$query = "UPDATE Products SET Product_Category = '$category',
					Product_Type = '$type',
					Product_Name = '$productName',
					Product_Colour = '$colour',
					Brand = '$brand',
					Gender = '$gender',
					Measurements = '$measurement',
					Cost_Price = '$costPrice',
					Sell_Price = '$sellPrice',
					Stock_Level = '$stockLevel'
					WHERE id = $id";
							  
							  
					$result = mysqli_query($connection, $query);
					

                        if ($result == false) { // If query failed - Updating product details failed (the update statement failed)
                            // Show error message
						
                           
							echo "failed to update: " . mysqli_error();
							
                        } else { // Updating product details was sucessful (the update statement worked)
                            // Show success message
							
                            echo "<script type='text/javascript'>alert('Update Product Successful!')</script>";
							echo "<script>window.location = 'Home.php';</script>";
							
                        }
					}
					 	else { // Incomplete update form
						
							echo "<script type='text/javascript'>alert('Please fill in all of the form')</script>";
						}
                }

                // Create and run select query to retrieve product details
                $query = "SELECT * FROM Products WHERE id = $id"; // Place required query in a variable
				
                $result = mysqli_query($connection, $query); // Execute query
                
                if ($result == false) { // If query failed
				
                    echo "<p>Getting product details failed.</p>";
					
                } else { // Query was successful   
				
                    $productDetails = mysqli_fetch_array($result, MYSQLI_ASSOC); // Get results (only 1 row 
                    // is required, and only 1 is returned due to using a primary key (id in this case) to 
                    // get the results)

                    if (empty($productDetails)) { // If getting product details failed
					
                        echo "<p>No product details found.</p>"; // Display error message
                    }
                }
		}
	
        ?>
            

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">SOSA Stock Managment</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
			<li><a href="Home.php">Home</a></li>
			<li><a href="Clothing.php">Clothing Products</a></li>
            <li><a href="Accessories.php">Accessorie Products</a></li>
            <li><a href="Add_Product.php">Add Product</a></li>
			<li><a href="">Search Product</a></li>
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Update Product</h1>
		  <br>
          <h2 class="sub-header">Edit Product</h2>
		  <p>Enter the following product details</p>
		  <br>
	
			<form id="Product" name="addProduct" action="<?php echo "?id=" . $productDetails["id"]; ?>" method="post">
				<div>
					<label>Product Category</label>
					<input type="text" class="form-control" name="category" value="<?php echo $productDetails["Product_Category"]; ?>"><br>
				<br>
				</div>
				<div>
					<label>Product Type</label>
					<input type="text" class="form-control" name="type" value="<?php echo $productDetails["Product_Type"]; ?>">
					<br>
				</div>
				<div>
					<label>Product Name:</label><br>
					<input type="text" class="form-control" name="productname" value="<?php echo $productDetails["Product_Name"]; ?>">
					<br>
				</div>
				<div>
					<label>Product Colour:</label><br>
					<input type="text" class="form-control" name="colour" value="<?php echo $productDetails["Product_Colour"]; ?>">
					<br>
				</div>
				<div>
					<label>Product Brand:</label><br>
					<input type="text" class="form-control" name="brand" value="<?php echo $productDetails["Brand"]; ?>" >
					<br>
				</div>
				<div>
					<label>Gender Of Product</label>
					<input type="text" class="form-control" name="gender" value="<?php echo $productDetails["Gender"]; ?>">
					<br>
				</div>
				<div>
					<label>Measurements</label>
					<input type="text" class="form-control" name="measurement" value="<?php echo $productDetails["Measurements"]; ?>">
					<br>
				</div>
				<div>
					<label>Cost Price</label>
					<input type="text" class="form-control" name="costprice" value="<?php echo $productDetails["Cost_Price"]; ?>">
					<br>
				</div>
				<div>
					<label>Sell Price</label>
					<input type="text" class="form-control" name="sellprice" value="<?php echo $productDetails["Sell_Price"]; ?>">	
					<br>		
				</div>	
				<div>
					<label>Stock Level</label>
					<input type="number" class="form-control" name="stocklevel" value="<?php echo $productDetails["Stock_Level"]; ?>">
					<br>
				</div>
				<div>
					<input id="updateSubmit" name="updateSubmit" value="Update Product" type="submit">
				</div>	
		
			</form>
		
			</div>
		</div>
	</div> 
		

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
