

<?php
if (isset($_POST['update'])) {
	try{
		require "config.php";
		require "common.php";
		$connection = new PDO ( $dsn );
	   $ID = $_POST['ID'];
	    $Productname = $_POST['Productname'];
	    $Cost = $_POST['Cost'];

	$sql= "UPDATE Product SET ID =:ID, Coverage_Name = :Productname, Cost= :Cost WHERE ID = :ID";
	$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':ID', $ID, PDO::PARAM_STR);
		$statement->bindParam ( ':Productname', $Productname, PDO::PARAM_STR);
		$statement->bindParam ( ':Cost', $Cost, PDO::PARAM_STR );
}catch ( PDOException $error ) {
		echo "<h1>Error Creating Product: </br></h1>";
		echo $sql . "<br>" . $error->getMessage ();
}
		echo "</br></br><h3>Product " . $Productname . " updated successfully!</h3>";
		exit ();
	}
	if (isset ( $_GET ['ID'] )) {
	
	try {
		
		require "config.php";
		require "common.php";
		
		$connection = new PDO ( $dsn);
		
		$sql = "SELECT * FROM Product WHERE ID = :ID";
		
		// $location = $_POST ['location'];
		$ID = $_GET ['ID'];
		
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':ID', $ID );
		$statement->execute ();
		
		$result = $statement->fetchAll ();
	} 
	catch ( PDOException $error ) {
		echo $sql . "<br>" . $error->getMessage ();
	}
}
	
?>
<?php
// if (isset ( $_POST ['submit'] )) {
if ($result) {
	?>

<form method="post">
	<?php
	foreach ( $result as $row ) {
		?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
<div class="col-xs-6 col-md-offset-3" style="background-color: #1B65D8.; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
		<label for="ID">Product ID</label>
		<input type="text" name="ID" id="ID" value="<?php echo escape($row["ID"]); ?>"> <label for="Productname">Product Name</label> <input type="text"
		name="Productname" id="Productname" value="<?php echo escape($row["Productname"]); ?>"> 
		<label for="Cost">Cost</label> <input type="int" name="Cost" id="Cost" value="<?php echo escape($row["Cost"]); ?>"></br>
		<input type="submit" name="update" value="update">

</div>
</div>
</form>
<?php
	}
	?>
<?php
} else 
{
	?>
<blockquote>No results found for <?php echo escape($_GET['ID']); ?>.</blockquote>
<?php
  }
 ?>
 </br>
