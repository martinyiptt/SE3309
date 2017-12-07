<?php require "templates/header.php"; ?>

<?php
/**
 * Function to query information based on
 * a parameter: in this case, location.
 *
 */
if (isset($_POST['submitCustomerID']))
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
if (isset($_POST['submitCustomerFullname']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT *
						FROM customer
						WHERE fullname = :fullname";
		$fullname = $_POST['fullname'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

if (isset($_POST['submitBranchnumber']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * FROM customer NATURAL JOIN customeraccount WHERE branchnumber = :branchnumber";
						





		$branchnumber = $_POST['branchnumber'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':branchnumber', $branchnumber, PDO::PARAM_STR);
		$statement->execute();
		$result = $statement->fetchAll();
	}

	catch(PDOException $error)
	{
		echo $sql . "<br>" . $error->getMessage();
	}
}

if (isset($_POST['submitMostMoney']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT customerid, fullname, email, accountnumber, balance FROM customer NATURAL JOIN customeraccount order by balance DESC limit 10";
						
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
		$sql = "SELECT * FROM customeraccount WHERE customerid = :customerid";
						

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


if (isset($_POST['submitTransactionHistory']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "SELECT * FROM transactiontype NATURAL join transactionhistory WHERE accountnumber = :accountnumber";
						

		$accountnumber = $_POST['accountnumber'];
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

if (isset($_POST['deleteAccount']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "DELETE FROM customer WHERE customerid = :customerid";
	
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



if (isset($_POST['deleteTransaction']))
{

	try
	{

		require "../config.php";
		require "../common.php";
		$connection = new PDO($dsn, $username, $password, $options);
		$sql = "DELETE FROM transactionhistory WHERE transactionid = :transactionid";
	
		$transactionid = $_POST['transactionid'];
		$statement = $connection->prepare($sql);
		$statement->bindParam(':transactionid', $transactionid, PDO::PARAM_STR);
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
	<input type="submit" name="submitCustomerID" value="View Results">
</form>


<a href="index.php">Back to home</a>

<?php
if (isset($_POST['submitCustomerID']))
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
				<td>
					<form method="post">
						<input type="text" id="customerid" name="customerid" value=<?php echo escape($row["customerid"]); ?>>
						<input type="submit" id="submitAccount" name="submitAccount" value="Account Detail">
						<input type="submit" id="deleteAccount" name="deleteAccount" value="Delete Account">
					</form>
				</td>
				
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





<h2>Find user based on Customer Name</h2>


<form method="post">
	<label for="fullname">Customer Name</label>
	<input type="text" id="fullname" name="fullname">
	<input type="submit" name="submitCustomerFullname" value="View Results">
</form>


<a href="index.php">Back to home</a>

<?php
if (isset($_POST['submitCustomerFullname']))
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
				<td>
					<form method="post">
						<input type="text" id="customerid" name="customerid" value=<?php echo escape($row["customerid"]); ?>>
						<input type="submit" id="submitAccount" name="submitAccount" value="Account Detail">
						<input type="submit" id="deleteAccount" name="deleteAccount" value="Delete Account">
					</form>
				</td>
				
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










<h2>Find all users in a branch</h2>


<form method="post">
	<label for="branchnumber">Branch Number</label>
	<input type="text" id="branchnumber" name="branchnumber">
	<input type="submit" name="submitBranchnumber" value="View Results">
</form>


<a href="index.php">Back to home</a>

<?php
if (isset($_POST['submitBranchnumber']))
{
	
	if ($result && $statement->rowCount() > 0)
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>customerid</th>
					<th>fullname</th>
					<th>email</th>
					<th>accountnumber</th>
					<th>balance</th>
					<th>adid</th>
					
					
				</tr>
			</thead>
			<tbody>
	<?php
		foreach ($result as $row)
		{ ?>
			<tr>
				<td><?php echo escape($row["customerid"]); ?></td>
				<td><?php echo escape($row["fullname"]); ?></td>
				<td><?php echo escape($row["accountnumber"]); ?></td>
				<td><?php echo escape($row["balance"]); ?></td>
				<td><?php echo escape($row["adid"]); ?></td>

				<<td>
					<form method="post">
						<input type="text" id="customerid" name="customerid" value=<?php echo escape($row["customerid"]); ?>>
						<input type="submit" id="submitAccount" name="submitAccount" value="Account Detail">
						<input type="submit" id="deleteAccount" name="deleteAccount" value="Delete Account">
					</form>
				</td>
				
			</tr>
		<?php
		} ?>
		</tbody>
	</table>
	<?php
	}
	else
	{ ?>
		<blockquote>No results found for <?php echo escape($_POST['branchnumber']); ?>.</blockquote>
	<?php
	}
}?>





<h2>Find the top 10 customers who have most money</h2>


<form method="post">
	<input type="submit" name="submitMostMoney" value="View Results">
</form>


<a href="index.php">Back to home</a>

<?php
if (isset($_POST['submitMostMoney']))
{
	
	
	if ($result && $statement->rowCount() > 0)
	{ ?>
		<h2>Results</h2>

		<table>
			<thead>
				<tr>
					<th>Customer ID</th>
					<th>Name</th>
					<th>Email</th>
					<th>Account Number</th>
					<th>Balance</th>
					
				</tr>
			</thead>
			<tbody>
	<?php
		foreach ($result as $row)
		{ ?>
			<tr>
				<td><?php echo escape($row["customerid"]); ?></td>
				<td><?php echo escape($row["fullname"]); ?></td>
				<td><?php echo escape($row["email"]); ?> </td>
				<td><?php echo escape($row["accountnumber"]); ?> </td>
				<td><?php echo escape($row["balance"]); ?> </td>
				<td>
					<form method="post">
						<input type="text" id="customerid" name="customerid" value=<?php echo escape($row["customerid"]); ?>>
						<input type="submit" id="submitAccount" name="submitAccount" value="Account Detail">
						<input type="submit" id="deleteAccount" name="deleteAccount" value="Delete Account">
					</form>
				</td>
				
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





<?php
if (isset($_POST['submitAccount']))
{
	
	if ($result && $statement->rowCount() > 0)
	{ ?>
		<h2>Account Detail</h2>

		<table>
			<thead>
				<tr>
					<th>Account Number</th>
					<th>balance</th>
					<th>Account Description ID</th>
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
				<td><?php echo escape($row["branchnumber"]); ?></td>
				

				<td>
					<a href="createTransaction.php">Add Transaction</a>
					<form method="post">
						<input type="text" id="accountnumber" name="accountnumber" value=<?php echo escape($row["accountnumber"]); ?>>
						<input type="submit" id="submitTransactionHistory" name="submitTransactionHistory" value="View Transaction History">
						<input type="submit" id="deleteAccount" name="deleteAccount" value="Delete Account">
					</form>
				</td>
				
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



<?php
if (isset($_POST['submitTransactionHistory']))
{
	
	if ($result && $statement->rowCount() > 0)
	{ ?>
		<h2>Account Detail</h2>

		<table>
			<thead>
				<tr>
					<th>transactionid</th>
					<th>transactiondate</th>
					<th>netchange</th>
					<th>transactiontypeid</th>
					<th>transactiontype</th>
					<th>method</th>

					
		
					
				</tr>
			</thead>
			<tbody>
	<?php
		foreach ($result as $row)
		{ ?>
			<tr>
				<td><?php echo escape($row["transactionid"]); ?></td>
				<td><?php echo escape($row["transactiondate"]); ?></td>
				<td><?php echo escape($row["netchange"]); ?></td>
				<td><?php echo escape($row["transactiontypeid"]); ?></td>
				<td><?php echo escape($row["transactiontype"]); ?></td>
				<td><?php echo escape($row["method"]); ?></td>
				<td>
					<form method="post">
						<input type="text" id="transactionid" name="transactionid" value=<?php echo escape($row["transactionid"]); ?>>
						<input type="submit" id="deleteTransaction" name="deleteTransaction" value="Delete This Transaction">
					</form>
				</td>
				
			</tr>
		<?php
		} ?>
		</tbody>
	</table>
	<?php
	}
	else
	{ ?>
		<blockquote>No results found for<?php echo escape($_POST['transactionid']); ?>.</blockquote>
	<?php
	}
}?>





<?php require "templates/footer.php"; ?>
