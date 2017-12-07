	<?php

	if (isset($_POST['submit'])){

		require "../config.php";
		require "../common.php";

	try{

		$connection = new PDO($dsn,$username,$password,$options);

		//Insert new user code goes here
		$new_transactionhistory = array(

			"transactionid"  => $_POST['transactionid'],
			"transactiondate"     => $_POST['transactiondate'],
			"netchange"       => $_POST['netchange'],
			"accountnumber"       => $_POST['accountnumber'],
			"transactiontypeid"       => $_POST['transactiontypeid']

		);
		$sql = sprintf(
	"INSERT INTO %s (%s) values (%s)",
	"transactionhistory",
	implode(",", array_keys($new_transactionhistory)),
	":" . implode(", :", array_keys($new_transactionhistory))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_transactionhistory);

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
	<blockquote><?php echo $_POST['branchname']; ?> successfully added.</blockquote>
<?php
} ?>


<h2>Add a transaction history</h2>

<form method="post">

	<label for="transactiondate">Transaction Date</label>
	<input type="text" name="transactiondate" id="transactiondate">

	<label for="netchange">Net change</label>
    <input type="text" name="netchange" id="netchange">

	<label for="accountnumber">Account Number</label>
    <input type="text" name="accountnumber" id="accountnumber">


	<label for="transactiontypeid">Transaction type id</label>
	<input type="text" name="transactiontypeid" id="transactiontypeid">



	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
