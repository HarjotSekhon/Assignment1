<?php
if(isset( $_GET ['ID'] )) {
	//include our connection
	require "config.php";
	require "common.php"; 
 
	//delete the row of selected id
	$ID = $_GET ['ID'];
	$sql = "DELETE FROM Coverage WHERE ID = :ID";
	$dsn->query($sql);
	$statement = $connection->prepare ( $sql );
		$statement->bindParam (':ID', $ID);
		$statement->execute ();
}
	header('location: index.php');
?>