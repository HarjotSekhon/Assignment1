<?php require "templates/header.php"; ?>
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
		$Coverage_name = $_POST ['Coverage_Name'];
		$Cost = $_POST ['Cost'];
	
		$sql = "INSERT INTO Coverage(ID,Coverage_Name,Cost) VALUES (:ID,:Coverage_Name LIKE '%Property%'OR'%adv%',:Cost)";
// 		echo "<h3>SQL:" . $sql . "</h3>";
		$statement = $connection->prepare ( $sql );
		$statement->bindParam ( ':ID', $ID);
		$statement->bindParam ( ':Coverage_Name', $Coverage_Name);
		$statement->bindParam ( ':Cost', $Cost );
		// $statement->execute ( $new_coverage );
		$statement->execute ();
	} catch ( PDOException $error ) {
		echo "<h1>Error Creating coverage: </br></h1>";
		echo $sql. "<br>" . $error->getMessage ();
		exit ();
	}
}
?>



<?php
if (isset ( $_POST ['submit'] ) && $statement) {
	?>
<blockquote><?php echo $_POST['Coverage_Name']; ?> successfully added.</blockquote>
<?php
}
?>

<h2>Add Coverage</h2>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<div class="container">
<div class="col-xs-6 col-md-offset-3" style="background-color: #1B65D8.; box-shadow: inset 1px -1px 1px #444, inset -1px 1px 1px #444;">
    <form method="post">
	<label for="ID">Coverage ID</label>
		<input type="text" name="ID" id="ID"> 
		<br><br><label for="Coverage_Name">Coverage Name</label> 
		<input type="text" name="Coverage_Name" id="Coverage_Name"></br></br>
		<br><label for="Cost"> Coverage Cost</label> <input type="int" name="Cost" id="Cost"></br>
		<br><input type="submit" name="submit" value="Submit"></br>
    </form>
</div>
</div>
</br>
<a href="index.php">Back to home</a>

<?php require "templates/footer.php"; ?>