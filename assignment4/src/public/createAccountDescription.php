	<?php

	if (isset($_POST['submit'])){

		require "../config.php";
		require "../common.php";

	try{

		$connection = new PDO($dsn,$username,$password,$options);

		//Insert new user code goes here
		$new_accountdescription = array(

			"adid"  => $_POST['adid'],
			"accounttype"     => $_POST['accounttype'],
			"typedescription"       => $_POST['typedescription'],
			"createddate"       => $_POST['createddate']
			
		);
		$sql = sprintf(
	"INSERT INTO %s (%s) values (%s)",
	"accountdescription",
	implode(",", array_keys($new_accountdescription)),
	":" . implode(", :", array_keys($new_accountdescription))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_accountdescription);

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
	<blockquote><?php echo $_POST['adid']; ?> successfully added.</blockquote>
<?php
} ?>










<h2>Add a account description</h2>

//CREATE TABLE customer
<form method="post">

	<label for="accounttype">Account Type</label>
	<input type="text" name="accounttype" id="accounttype">

	<label for="typedescription">Type Description</label>
	<input type="text" name="typedescription" id="typedescription">


	<label for="createddate">Created Date</label>
    <input type="text" name="createddate" id="createddate">


	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
