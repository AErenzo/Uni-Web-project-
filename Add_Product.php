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
		{ // If connection error
  
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
			
        } 
		else 
			
            if (isset($_POST["submitProduct"])) 
			{ // If add form submitted
                // Check all parts of the form have a value
			
				if ((!empty($_POST["category"])) && (!empty($_POST["type"])) 
                        && (!empty($_POST["productname"])) && (!empty($_POST["colour"])) 
                        && (!empty($_POST["brand"])) && (!empty($_POST["gender"]))
						&& (!empty($_POST["measurement"])) && (!empty($_POST["costprice"]))
						&& (!empty($_POST["sellprice"])) && (!empty($_POST["stocklevel"])))
				{
                    // Create and run insert query to add product details
                    $query = "INSERT INTO Products (Product_Category, Product_Type, Product_Name, Product_Colour, Brand, Gender, Measurements, Cost_Price, Sell_Price, Stock_Level) "
					
							. "VALUES ('" . $_POST["category"] . "', '" . $_POST["type"] . "', '"
                            . $_POST["productname"] . "', '" . $_POST["colour"] . "', '"
							. $_POST["brand"] . "', '" . $_POST["gender"] . "', '"
							. $_POST["measurement"] . "', '" . $_POST["costprice"] . "', '"
                            . $_POST["sellprice"] . "', '" . $_POST["stocklevel"] . "');";
                   
				   $result = mysqli_query($connection, $query);

                    if ($result == false) { // If query failed - Adding product details failed (the insert statement failed)
                        // Show error message
						
                        echo"<script type='text/javascript'>alert('Adding product failed!')</script>"; 
						
                    } 
					else 
					{ // Adding product details was successful (the insert statement worked)
                        // Show success message
						echo"<script type='text/javascript'>alert('Adding Product sucessful!')</script>";
						echo "<script>window.location = 'Home.php';</script>";
                    }   	
                } 	else { // Incomplete add form
				
						echo "<script type='text/javascript'>alert('Please fill in all of the form!')</script>";
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
          </ul>
          
        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Add Product</h1>
		  <br>
          <h2 class="sub-header">New Product</h2>
		  <p>Enter the following product details</p>
		  <br>
	
			<form id="addProduct" name="addProduct" action="?" method="post">
				<div>
					<label>Product Category</label>
					<select class="form-control" name="category">
						<option value="Clothing">Clothing</option>
						<option value="Accessory">Accessory</option>
					</select> 
				<br>
				</div>
				<div>
					<label>Product Type</label>
					<select class="form-control"  Name="type">
						<option value="Jumpers & Cardigans"> Jumpers & Cardigans</option>
						<option value="Jackets & Coats">Jackets & Coats</option>
						<option value="T-Shirts & Polo Shirts">T-shirt & Polo Shirt</option>
						<option value="Shirts">Shirts</option>
						<option value="Blouses">Blouses</option>
						<option value="Trousers & Jeans">Trousers & Jeans</option>
						<option value="Shorts">Shorts</option>
						<option value="Skirts">Skirts</option>
						<option value="Hats">Hats</option>
						<option value="Shoes & Trainers">Shoes & Trainers</option>
						<option value="Socks">Socks</option>
						<option value="Tights">Tights</option>
						<option value="Underware & Nightware">Underware & Nightware</option>
						<option value="Bags">Bags</option>
						<option value="Wallets">Wallets</option>
						<option value="Purses">Purse</option>
					</select> 
					<br>
				</div>
				<div>
					<label>Product Name:</label><br>
					<input type="text" class="form-control" name="productname" placeholder="Product Name"><br>
				</div>
				<div>
					<label>Product Colour:</label><br>
					<input type="text" class="form-control" name="colour" placeholder="Product Colour"><br>
				</div>
				<div>
					<label>Product Brand:</label><br>
					<input type="text" class="form-control" name="brand" placeholder="Product Brand"><br>
				</div>
				<div>
					<label>Gender Of Product</label>
					<select class="form-control" name="gender">
						<option value="Mens">Mens</option>
						<option value="Womens">Womens</option>
					</select>
				</div>
				<div>
					<br>
					<label>Measurements</label>
					<input type="text" class="form-control" name="measurement" placeholder="Measurements">
					<br>
				</div>
				<div>
					<label>Cost Price</label>
					<input type="text" class="form-control" name="costprice" placeholder="Cost Price">
				</div>
				<div>
					<br>
					<label>Sell Price</label>
					<input type="text" class="form-control" name="sellprice" placeholder="Sell Price">		
				</div>	
				<div>
					<br>
					<label>Stock Level</label>
					<input type="number" class="form-control" name="stocklevel" placeholder="Stock Level">
					<br>
				</div>
				<div>
					<input id="submitProduct" name="submitProduct" value="Submit Product" type="submit">
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
