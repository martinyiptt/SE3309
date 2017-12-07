<?php require "templates/header.php"; ?>

<?php
/**
 * Function to query information based on
 * a parameter: in this case, location.
 *
 */
if (isset($_POST['submit1']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT *
						FROM customer
						WHERE customerid = :customerid";
		$customerid = $_POST['customerid'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':customerid', $customerid, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

if (isset($_POST['submitAccount']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT *
						FROM customeraccount
						WHERE accountnumber = :accountnumber";
		$customerid = $_POST['accountnumber'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':accountnumber', $accountnumber, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}
?>

<h2>Find user based on Customer ID</h2>


<form method="post">
	<label for="customerid">Customer ID</label>
	<input type="text" id="customerid" name="customerid">
	<input type="submit" name="submit1" value="View Results">
</form>


<a href="index.php">Back to home</a>

<?php
if (isset($_POST['submit1']) ||isset($_POST['submit2']))
{
	
	if ($result && $statement->rowCount() > 0)
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Customer Id</th>
					<th>Name</th>
					<th>Street</th>
					<th>City</th>
					<th>Province</th>
					<th>Postal Code</th>
					<th>Phone</th>
					<th>Email</th>
					
				</tr>
			</thead>
			<tbody>
	<?php
		foreach ($result as $row)
		{ ?>
			<tr>
				<td><?php echo escape($row["customerid"]); ?></td>
				<td><?php echo escape($row["fullname"]); ?></td>
				<td><?php echo escape($row["dateofbirth"]); ?></td>
				<td><?php echo escape($row["street"]); ?></td>
				<td><?php echo escape($row["city"]); ?></td>
				<td><?php echo escape($row["province"]); ?></td>
				<td><?php echo escape($row["postal"]); ?> </td>
				<td><?php echo escape($row["phone"]); ?> </td>
				<td><?php echo escape($row["email"]); ?> </td>
				<td><form method="post"><input type="submit" id="submitAccount" name="submitAccount" value="Account Detail"></form></td>
				
			</tr>
		<?php
		} ?>
		</tbody>
	</table>
	<?php
	}
	else
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['customerid']); ?>.</blockquote>
	<?php
	}
}?>

<form method="post">
	<label for="accountnumber">Account Number</label>
	<input type="text" id="accountnumber" name="accountnumber">
	<input type="submit" name="submitAccount" value="Account Detail">
</form>

<?php
if (isset($_POST['submitAccount']))
{
	
    echo '<script language="javascript">';
	echo 'alert("test")';
	echo '</script>';
	
	 ?>
		<h2>Account Detail</h2>

		<table>
			<thead>
				<tr>
					<th>Account Number</th>
					<th>Balance </th>
					<th>adid</th>
					<th>customerid</th>
					<th>branchnumber</th>
				</tr>
			</thead>
			<tbody>
	<?php
		foreach ($result as $row)
		{ ?>
			<tr>
				<td><?php echo escape($row["accountnumber"]); ?></td>
				<td><?php echo escape($row["balance"]); ?></td>
				<td><?php echo escape($row["adid"]); ?></td>
				<td><?php echo escape($row["customerid"]); ?></td>
				<td><?php echo escape($row["branchnumber"]); ?></td>
				<td><button type="submit" id="editAccountButton" name="submitAccount" value="View Results">Edit Account Info</button></td>
			</tr>
		<?php
		} ?>
		</tbody>
	</table>
	<?php
}?>








<?php require "templates/footer.php"; ?>
