<?php

	if (isset($_POST['submit'])){

		require "../config.php";
		require "../common.php";

	try{

		$connection = new PDO($dsn,$username,$password,$options);

		//Insert new user code goes here
		$new_account = array(

			"customerid"       => $_POST['customerid'],
			"balance"     => $_POST['balance'],
			"adid"       => $_POST['adid'],
			"branchnumber"       => $_POST['branchnumber']
		);
		$sql = sprintf(
	"INSERT INTO %s (%s) values (%s)",
	"customeraccount",
	implode(",", array_keys($new_account)),
	":" . implode(", :", array_keys($new_account))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_account);

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
	<blockquote><?php echo $_POST['accountnumber']; ?> successfully added.</blockquote>
<?php
} ?>










<h2>Add account</h2>


<form method="post">

	<label for="customerid">Customer ID</label>
    <input type="text" name="customerid" id="customerid">

	<label for="balance">Balance</label>
	<input type="text" name="balance" id="balance">


	<label for="adid">Account Description ID</label>
    <input type="text" name="adid" id="adid">


	<label for="branchnumber">Branch Number</label>
	<input type="text" name="branchnumber" id="branchnumber">


	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
