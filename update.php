<?php
	//include our connection
	if(isset( $_GET['ID'] )) {
	require "common.php";
	require "config.php";
    $ID = $_GET['ID'];
	//get the row of selected id
	$sql = "SELECT * FROM Coverage WHERE ID = :ID";
	$statement = $connection->prepare ( $sql );
	$statement->bindParam ( ':ID', $ID);
	$query = $dsn->query($sql);
	
	}
?>

<html>
<form method="post">
		<label for="ID">ID</label>
		<input type="text" name="ID" id="ID"> <label for="Coverage_Name">Coverage Name</label> <input type="text"
		name="Coverage_Name" id="Coverage_Name"> 
		<label for="Cost">Cost</label> <input type="int" name="Cost" id="Cost"></br>
		<input type="submit" name="update" value="update">
</form>
<?php
if (isset($_POST['update'])) {
		require "config.php";
		require "common.php";
	$ID = $_POST['ID'];
	$Coverage_Name = $_POST['Coverage_Name'];
	$Cost = $_POST['Cost'];

	$sql= "UPDATE Coverage SET ID ='$ID', Coverage_Name = '$Coverage_Name'  Cost= '$Cost' WHERE ID = :ID";
	
	$_SESSION['message'] = "Address updated!"; 
	header('location: index.php');
}
?>
</html>