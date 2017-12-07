	<?php

	if (isset($_POST['submit'])){

		require "../config.php";
		require "../common.php";

	try{

		$connection = new PDO($dsn,$username,$password,$options);

		//Insert new user code goes here
		$new_customer = array(

			"fullname"  => $_POST['fullname'],
			"dateofbirth"     => $_POST['dateofbirth'],
			"street"       => $_POST['street'],
			"city"       => $_POST['city'],
			"province"       => $_POST['province'],
			"postal"       => $_POST['postal'],
			"phone"       => $_POST['phone'],
			"email"       => $_POST['email']

		);
		$sql = sprintf(
	"INSERT INTO %s (%s) values (%s)",
	"customer",
	implode(",", array_keys($new_customer)),
	":" . implode(", :", array_keys($new_customer))
	);

	$statement = $connection->prepare($sql);
	$statement->execute($new_customer);

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
	<blockquote><?php echo $_POST['firstname']; ?> successfully added.</blockquote>
<?php
} ?>










<h2>Add a user</h2>

//CREATE TABLE customer
<form method="post">

	<label for="fullname">Full Name</label>
	<input type="text" name="fullname" id="fullname">

	<label for="dateofbirth">Date of Birth</label>
	<input type="text" name="dateofbirth" id="dateofbirth">


	<label for="city">Street</label>
    <input type="text" name="city" id="street">

	<label for="city">City</label>
    <input type="text" name="city" id="city">


	<label for="province">Province</label>
	<input type="text" name="province" id="province">


	<label for="postal">postal</label>
	<input type="text" name="postal" id="postal">


    <label for="phone">phone</label>
    <input type="text" name="phone" id="phone">

	<label for="email">Email Address</label>
    <input type="text" name="email" id="email">


	<input type="submit" name="submit" value="Submit">
</form>

<a href="index.php">Back to home</a>

<?php include "templates/footer.php"; ?>
