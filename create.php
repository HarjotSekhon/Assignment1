<?php require "templates/header.php"; ?>

<html>
<head>
<script type="text/javascript">
		function reg()                                    
       { 
    var Productname = document.forms["createpro"]["Productname"];                
    var Cost = document.forms["createpro"]["Cost"];
	var ID = document.forms["createpro"]["ID"];
    if (Productname.value == "")                                  
    { 
        window.alert("Please enter Product name."); 
        name.focus(); 
        return false; 
    } 
	if (Productname.value <= 3 && textbox.value.length >= 25) {  
        window.alert("Please enter Product name between 3 to 25 CHARACHTER"); 
        name.focus(); 
        return false; 
    } 
	
	if (Cost.value == "")                                  
    { 
        window.alert("Please enter Cost"); 
        name.focus(); 
        return false; 
    } 
	if (ID.value == "")                                  
    { 
        window.alert("Please enter Product ID"); 
        name.focus(); 
        return false; 
    } 
	
	   }
   
 </script>
 </head>
<body>
<h2>Add Product</h2>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
<div class="col-xs-6 col-md-offset-3" style="background-color: #1B65D8.; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
    <form name="createpro" onsubmit="return reg()" method="post">
	<label for="ID">ID</label>
		<input type="int" name="ID" id="ID"> 
		<br><br><label for="Productname">Product Name</label> 
		<input type="text" maxlength="25" minlength="3" name="Productname" id="Productname"></br></br>
		<br><label for="Cost">Product Cost</label> 
		<input type="int" name="Cost" id="Cost"></br>
		<br><input type="submit" name="submit" value="Submit"></br>

    </form>
</div>
</div>
</br>
</body>
</html>
<?php

/**
 * Use an HTML form to create a new entry in the
 * table.
 *
 */
if (isset ( $_POST ['submit'] )) {
	
	require "config.php";
	require "common.php";
	
	try {
		// $connection = new PDO ( $dsn, $username, $password, $options );
		$connection = new PDO ( $dsn );
		$connection->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		echo $dsn;
		
		$ID = $_POST ['ID'];
		$Productname = $_POST['Productname'];
		$Cost = $_POST ['Cost'];
	
		$sql = "INSERT INTO Product(ID,Productname,Cost) VALUES (:ID,:Productname,:Cost)";
// 		echo "<h3>SQL:" . $sql . "</h3>";
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':ID', $ID);
		$statement->bindParam ( ':Productname', $Productname);
		$statement->bindParam ( ':Cost', $Cost );
		// $statement->execute ( $new_product );
		$statement->execute ();
	} catch ( PDOException $error ) {
		echo "<h1>Error Creating Product: </br></h1>";
		echo $sql. "<br>" . $error->getMessage ();
		exit ();
	}
}
?>



<?php
if (isset ( $_POST ['submit'] ) && $statement) {
	?>
<blockquote><?php echo $_POST['Productname']; ?> successfully added.</blockquote>
<?php
}
?>
<a href="index.php">Back to home</a>
<?php require "templates/footer.php"; ?>