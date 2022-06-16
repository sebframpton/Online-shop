<?php
	// get the head of the html page
	//ensure that you include your namein the title
	include "./templates/head.php"; 
	
	/* This page contains a drop down box that displays all of the 
	** customers (First & Last Name). When selected there should be a form that displays 
	** a list of all invoices for that customer (at least Invoice number, date, total cost. 
	** Additionally you could generate the list as links and clicking on the link would take 
	** the user to a page that displays all of the invoice details.
	*/
	
	// Display all customers so that we can view all of their details and invoices
	
	// Check if the submit button has been clicked, if not then display the form
	// with the combo box (select box)
	// the name of the button must match (i.e. submit)
	if(!isset($_POST['submit']))
	{
	?>
		<h1>Customers</h1>
		<!-- the form action is this page -->
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class='centre'>
	<?php	
	// get the connection script
		require('connect.php');

		$res = mysqli_query($conn, "SELECT * FROM customer");
		if(mysqli_num_rows($res) > 0 )
		{
			echo "Choose Customer: ";
			// Display the first option of the select box
			echo "<select name='select_customer'>
						<option value = '0'> Please Select...</option>";
			
			// iterate through the result and display the name for each customer
			while($row=mysqli_fetch_array($res))
			{
				// the ID remains "hidden" but we use this as the identifier 
				// only the name is displayed
				echo "<option value='" . $row['ID'] . "'>" . $row['FName'] . ' ' . $row['LName'] . "</option>";
			}
			echo "</select>";
			// free the resources
			mysqli_free_result($res);
		}
		else
		{
			// if nothing was returned from the database 
			echo "<p>There are no customers to display</p>";
		}
		
		mysqli_close($conn);
		?>
			<input type="submit" name="submit" value="Submit">
		</form>
		
		<?php
		
	}
	else
	{
		require('connect.php');
		//get the customer details
		$custID = $_POST['select_customer'];
		$sql = mysqli_query($conn, "SELECT FName, LName, Address, Suburb, State, PostCode, Phone, Comments FROM customer WHERE ID = '$custID'");
		$cust = mysqli_fetch_row($sql);
		
		// note that the array elements relate to the order of the query above
		// you must use the index (not field names) when using mysqli_fetch_row
		echo "<h1>$cust[0] $cust[1]</h1>";
		
		// here you should include all of the selected customer's details and then the details of all invoices for that customer 
		// (e.g. Invoice number, date & total cost)
	}

	// get the rest of the html 
	include "./templates/foot.php"; 
?>
