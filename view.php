<?php
require "templates/header.php";

try {
	
	require "config.php";
	require "common.php";
	
	// $connection = new PDO ( $dsn, $username, $password, $options );
	$connection = new PDO ( $dsn );
	
	$sql = "SELECT * FROM Coverage";
	
	$statement = $connection->prepare ( $sql );
	$statement->execute ();
	
	$result = $statement->fetchAll (PDO::FETCH_ASSOC);
} catch ( PDOException $error ) {
	echo $sql . "<br>" . $error->getMessage ();
}

?>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<table class="table table-bordered">
	    <thead>
			<tr>
			  <th> Coverage Id</th>
			  <th>Name</th>
			  <th>Cost</th>
			   <th>Action</th>
			</tr>
		</thead>
		<tbody>
	<?php
	$className = "'confirmation'";
	foreach ( $result as $row ) {
		?>
			<tr>
			<td><?php echo escape($row["ID"]); ?></td>
			<td><?php echo escape($row["Coverage_Name"]); ?></td>
			<td><?php echo escape($row["Cost"]); ?></td>
			</tr>
		<?php
	}
	?>
		</tbody>
	</table>