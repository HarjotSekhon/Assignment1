<?php
require "templates/header.php";

try {
	
	require "config.php";
	require "common.php";
	
	// $connection = new PDO ( $dsn, $username, $password, $options );
	$connection = new PDO ( $dsn );
	
	$sql = "SELECT * FROM Product";
	
	$statement = $connection->prepare ( $sql );
	$statement->execute ();
	
	$result = $statement->fetchAll (PDO::FETCH_ASSOC);
} catch ( PDOException $error ) {
	echo $sql . "<br>" . $error->getMessage ();
}
?>

<html>
<head>
    <meta charset="utf-8">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
            <div class="row">
                
            </div>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-primary">Create New Product</a>
                </p>
                <table class="table table-bordered">
				  <thead>
			<tr>
			  <th>Id</th>
			  <th>Product Name</th>
			  <th> Product Cost</th>
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
			<td><?php echo escape($row["Productname"]); ?></td>
			<td><?php echo escape($row["Cost"]); ?></td>
		    <td><?php echo "<a href=" . "delete.php?id=". $row["ID"] . " class=" . $className . "> Delete </a>" ?>
			<?php echo "<a href=" . "update.php?id=" . $row["ID"] . ">" . "Update</a>" ?> </td>
			</tr>
		<?php
	}
	?>
		</tbody>
		
		</div>
		</div>
		<script type='text/javascript'>
		$action = isset($_GET['action']) ? $_GET['action'] : "";
 
// if it was redirected from delete.php
if($action=='Delete'){
    echo "<div class='alert alert-success'>Record was deleted.</div>";
}
function delete_Coverage(ID ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete.php?ID=' + ID;
    } 
}
</script>
	</body>
</html>