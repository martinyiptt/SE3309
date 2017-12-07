	<?php

	if (isset($_POST['submit'])){

		require "../config.php";
		require "../common.php";

	try{

		$connection = new PDO($dsn,$username,$password,$options);

		//Insert new user code goes here
		$new_transactiontype = array(

			
			"transactiontype"     => $_POST['transactiontype'],
			"method"       => $_POST['method']
		);
		$sql = sprintf(
	"INSERT INTO %s (%s) values (%s)",
	"transactiontype",
	implode(",", array_keys($new_transactiontype)),
	":" . implode(", :", array_keys($new_transactiontype))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_transactiontype);

	
	}

	catch(PDOException $error){

		echo $sql ."<br>" . $error->getMessage();
	}


	}

?>


<?php include "templates/header.php"; ?>


<?php
if (isset($_POST['submit']) && $statement)
{ ?>
	<blockquote><?php echo $_POST['transactiontypeid']; ?> successfully added.</blockquote>
<?php
} ?>


<h2>Add a Transaction</h2>

<form method="post">

	<label for="transactiontype">Transaction Type</label>
	<input type="text" name="transactiontype" id="transactiontype">

	<label for="method">Method</label>
    <input type="text" name="method" id="method">

	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
