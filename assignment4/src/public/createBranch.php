	<?php

	if (isset($_POST['submit'])){

		require "../config.php";
		require "../common.php";

	try{

		$connection = new PDO($dsn,$username,$password,$options);

		//Insert new user code goes here
		$new_branch = array(

			"branchname"  => $_POST['branchname'],
			"branchnumber"     => $_POST['branchnumber'],
			"street"       => $_POST['street'],
			"city"       => $_POST['city'],
			"province"       => $_POST['province'],
			"postal"       => $_POST['postal']

		);
		$sql = sprintf(
	"INSERT INTO %s (%s) values (%s)",
	"branch",
	implode(",", array_keys($new_branch)),
	":" . implode(", :", array_keys($new_branch))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_branch);

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


<h2>Add a branch</h2>

<form method="post">

	<label for="branchname">Branch Name</label>
	<input type="text" name="branchname" id="branchname">

	<label for="street">Street</label>
    <input type="text" name="street" id="street">

	<label for="city">City</label>
    <input type="text" name="city" id="city">


	<label for="province">Province</label>
	<input type="text" name="province" id="province">


	<label for="postal">Postal code</label>
	<input type="text" name="postal" id="postal">


	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
