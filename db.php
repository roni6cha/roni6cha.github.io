<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>Ballroom Company</title>
		<link rel="stylesheet" href="includes/style.css">

		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
		<div id="wrapper">
			<?php
			$servername = "localhost";
			$username = "roni6ch";
			$password = "12345";
			$dbname = "Ballroom Company";

			// Create connection
			$conn = new mysqli($servername, $username, $password, $dbname);
			// Check connection
			if ($conn -> connect_error) {
				die("Connection failed: " . $conn -> connect_error);
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////INSERT////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

			if (isset($_REQUEST['insert']) == TRUE) {//isset helpes me to check if i need to get in the switch case function
				switch($_REQUEST['insert']) {//check if we pressed on the submit insert costumer button

					case 'Delete' :
						$id1 = $_REQUEST["id"];
						$sql0 = "SELECT id FROM employees WHERE id=$id1";
						$result = $conn -> query($sql0);
						if ($result -> num_rows > 0) {
							$sql1 = "DELETE FROM employees WHERE id=$id1";
							$result1 = $conn -> query($sql1);
							echo "Delete Completed";
						} else {
							echo "there is no such id!";
						}
						break;

					case 'EventsPerYear' :
						$year1 = $_REQUEST["year"];
						$sql0 = "SELECT event,YEAR (date) FROM orders WHERE YEAR (date) = $year1";
						$result = $conn -> query($sql0);
						if ($result -> num_rows > 0)
							while ($row = $result -> fetch_object()) {
								$event = $row -> event;
								$sql2 = "SELECT name FROM events WHERE code=$event";
								$result2 = $conn -> query($sql2);
								while ($row2 = $result2 -> fetch_assoc()) {
									echo "year: " . $year1;
									echo " ,event: " . $row2["name"] . "<br>";
								}
							}
						else
							echo "there is no events on that year<br>";
						break;

					case 'costumer' :
						// Catch the textFileds
						$name1 = $_REQUEST["name1"];
						$adress1 = $_REQUEST["adress1"];
						$phone1 = $_REQUEST["phone1"];
						$billNum1 = $_REQUEST["billNum1"];

						// insert new row to EMPLOYEES
						$sql = "INSERT INTO costumers (name, adress, phone, billNum) VALUES ('$name1', '$adress1', '$phone1', '$billNum1')";
						if ($conn -> query($sql) === TRUE) {
							echo "New record created successfully <br>";
						} else {
							echo "Error: " . $sql . "<br>" . $conn -> error . "<br>";
						}
						break;

					case 'employee' :
						// Catch the textFileds
						$name2 = $_REQUEST["name2"];
						$family2 = $_REQUEST["family2"];
						$sex2 = $_REQUEST["sex2"];
						$birth2 = $_REQUEST["birth2"];
						$startDate2 = $_REQUEST["startDate2"];
						$role2 = $_REQUEST["role2"];
						$adress2 = $_REQUEST["adress2"];
						$phone2 = $_REQUEST["phone2"];
						// insert new row to COSTUMERS
						$sql = "INSERT INTO employees (name, family, sex, birth, startDate, role, adress, phone) VALUES ('$name2', '$family2', '$sex2', '$birth2','$startDate2','$role2','$adress2','$phone2')";
						if ($conn -> query($sql) === TRUE) {
							echo "New record created successfully <br>";
						} else {
							echo "Error: " . $sql . "<br>" . $conn -> error . "<br>";
						}
						break;

					case 'event' :
						// Catch the textFileds
						$name3 = $_REQUEST["name3"];
						$sql3 = "SELECT name FROM events WHERE name='$name3'";
						$result = $conn -> query($sql3);
						if ($result -> num_rows > 0) {
							//we have that name
							echo "we have allready that event, please try a new event";
						}
						else {
							//we dont have that name - good
							$sql = "INSERT INTO events (name) VALUES ('$name3')";
							$result0 = $conn -> query($sql);
							echo "New record created successfully <br>";
						}
						break;

					case 'halls' :
						// Catch the textFileds
						$name4 = $_REQUEST["name4"];
						$capacity4 = $_REQUEST["capacity4"];

						
						
						$sql3 = "SELECT name FROM halls WHERE name='$name4'";
						$result = $conn -> query($sql3);
						if ($result -> num_rows > 0) {
							//we have that name
							echo "we have allready that hole, please try a new hole";
						}
						else {
							//we dont have that name - good
							$sql = "INSERT INTO halls (name, capacity) VALUES ('$name4', '$capacity4')";
							$result0 = $conn -> query($sql);
							echo "New record created successfully <br>";
						}
						break;

					case 'menus' :
						// Catch the textFileds
						$name5 = $_REQUEST["name5"];
						$price5 = $_REQUEST["price5"];

						$sql3 = "SELECT name FROM menus WHERE name='$name5'";
						$result = $conn -> query($sql3);
						if ($result -> num_rows > 0) {
							//we have that name
							echo "we have allready that menu, please try a new menu";
						}
						else {
							//we dont have that name - good
							$sql = "INSERT INTO menus (name, price) VALUES ('$name5', '$price5')";
							$result0 = $conn -> query($sql);
							echo "New record created successfully <br>";
						}
						break;

					case 'orders' :
						$checker = false;
						// Catch the textFileds
						//$num6 = $_REQUEST["num6"];
						$date6 = $_REQUEST["date6"];
						$amount6 = $_REQUEST["amount6"];
						$costumer6 = $_REQUEST["costumer6"];
						$bill6 = $_REQUEST["bill6"];
						$employee6 = $_REQUEST["employee6"];
						$event6 = $_REQUEST["event6"];
						$menu6 = $_REQUEST["menu6"];
						$hall6 = $_REQUEST["hall6"];

						//$sql = $conn -> query("SELECT id FROM costumers WHERE id = $costumer6");
						//$sql2 = $conn -> query("SELECT code FROM bills WHERE code = $bill6");
						$sql3 = $conn -> query("SELECT id FROM employees WHERE id = $employee6");
						$sql4 = $conn -> query("SELECT code FROM events WHERE code = $event6");
						$sql5 = $conn -> query("SELECT num FROM menus WHERE num = $menu6");
						$sql6 = $conn -> query("SELECT CodeHall FROM halls WHERE CodeHall = $hall6");
						$sql7 = $conn -> query("SELECT CodeHall,capacity FROM halls WHERE CodeHall = $hall6");

						//check if date and hall  - we dont have twice!
						$sql8 = "SELECT date,CodeHall FROM orders WHERE date = '$date6' AND CodeHall = '$hall6'";
						$result4 = $conn -> query($sql8);
						if ($result4 -> num_rows > 0)
						{
							echo "there is allready event on that hole on the same date, please try again!";
							break;
						}
						
						$row = mysqli_fetch_array($sql3);

						if ($row[0] >= 1) {
							$row = mysqli_fetch_array($sql4);
							if ($row[0] >= 1) {
								$row = mysqli_fetch_array($sql5);
								if ($row[0] >= 1) {
									$row = mysqli_fetch_array($sql6);
									$row2 = mysqli_fetch_array($sql7);
									if ($row[0] >= 1) {
										if ($row2["capacity"] >= $amount6)
										{
											$sql2 = $conn -> query("INSERT INTO bills (issueDate, money) VALUES ('$date6', '$amount6'*200)");
											$checker = true;
										}
										else {
											echo "there is no capacity in this hall";
										}
									} else {
										echo "hall NOT exist in HALLS <br>";
									}
								} else {
									echo "menu NOT exist in MENUS <br>";
								}
							} else {
								echo "event NOT exist in EVENTS <br>";
							}
						} else {
							echo "employee NOT exist in EMPLOYEES <br>";
						}

						
						
						if ($checker == true) {
							// insert new row to ORDERS
							$sql = "INSERT INTO orders (date, amount, costumer, bill, employee, event, menu, CodeHall) VALUES ('$date6', '$amount6','$costumer6','$bill6' ,'$employee6', '$event6', '$menu6', '$hall6')";
							if ($conn -> query($sql) === TRUE) {
								echo "New Order created successfully <br>";
								echo "and New Bill created successfully - amount of people * 200 <br>";
							} else {
								echo "Error: " . $sql . "<br>" . $conn -> error . "<br>";
							}
						}
						break;

					case 'roles' :
						// Catch the textFileds
						$description7 = $_REQUEST["description7"];


						$sql3 = "SELECT description FROM roles WHERE description='$description7'";
						$result = $conn -> query($sql3);
						if ($result -> num_rows > 0) {
							//we have that name
							echo "we have allready that role, please try a new role";
						}
						else {
							//we dont have that role - good
							$sql = "INSERT INTO roles (description) VALUES ('$description7')";
							$result0 = $conn -> query($sql);
							echo "New record created successfully <br>";
						}
						break;

					case 'servings' :
						// Catch the textFileds
						$name8 = $_REQUEST["name8"];
						$description8 = $_REQUEST["description8"];

						
						$sql3 = "SELECT name,description FROM servings WHERE name='$name8' AND description='$description8'";
						$result = $conn -> query($sql3);
						if ($result -> num_rows > 0) {
							//we have that name
							echo "we have allready that serving, please try a new serving";
						}
						else {
							//we dont have that name - good
							$sql = "INSERT INTO servings (name, description) VALUES ('$name8', '$description8')";
							$result0 = $conn -> query($sql);
							echo "New record created successfully <br>";
						}
						break;

					case 'bills' :
						// Catch the textFileds
						$issueDate9 = $_REQUEST["issueDate9"];
						$lastDatePayment9 = $_REQUEST["lastDatePayment9"];
						$money9 = $_REQUEST["money9"];

						// insert new row to BILLS
						$sql = "INSERT INTO bills (issueDate, lastDatePayment,money) VALUES ('$issueDate9', '$lastDatePayment9', '$money9')";
						if ($conn -> query($sql) === TRUE) {
							echo "New record created successfully <br>";
						} else {
							echo "Error: " . $sql . "<br>" . $conn -> error . "<br>";
						}
						break;
				}
			}
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////INFORMATION////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if (isset($_REQUEST['print']) == TRUE) {
				switch($_REQUEST['print']) {

					case 'EmployeesByOrder' :
						//print EmployeesByOrder in orders
						$sql = "SELECT num, employee FROM orders ORDER BY num DESC";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_object()) {
								$sql2 = "SELECT name FROM employees WHERE id=$row->employee";
								$result2 = $conn -> query($sql2) -> fetch_object();
								if (!empty($result2 -> name)) {
									echo "num of order: " . $row -> num . "<br>";
									echo " employee: " . $result2 -> name . "<br><br>";
								}
							}
						} else {
							echo "0 results";
						}
						break;

					case 'costumers' :
						//print all the rows in costumers
						$sql = "SELECT id, name, adress, phone FROM costumers";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "<b>id: </b>" . $row["id"] . " ,<b> Name: </b>" . $row["name"] . " , <b>adress:</b> " . $row["adress"] . " , <b>phone:</b> " . $row["phone"] . "<br>";

							}
						} else {
							echo "0 results";
						}
						break;

					case 'employee' :
						//print all the rows in employee
						$sql = "SELECT id, name, family, sex, birth, startDate, role, adress, phone FROM employees";

						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "id: " . $row["id"] . " , Name: " . $row["name"] . " , Family: " . $row["family"] . " , Sex: " . $row["sex"] . " , Birth: " . $row["birth"] . " , startDate: " . $row["startDate"] . " , Role: " . $row["role"] . " , adress: " . $row["adress"] . " , phone: " . $row["phone"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'event' :
						//print all the rows in events
						$sql = "SELECT code, name FROM events";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "code: " . $row["code"] . " , Name: " . $row["name"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'halls' :
						//print all the rows in halls
						$sql = "SELECT CodeHall, name, capacity FROM halls";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "code: " . $row["CodeHall"] . " , Name: " . $row["name"] . " , Capacity: " . $row["capacity"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'menus' :
						//print all the rows in menus
						$sql = "SELECT num, name, price FROM menus";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "num: " . $row["num"] . " , Name: " . $row["name"] . " , Price: " . $row["price"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'orders' :
						//print all the rows in orders
						$sql = "SELECT num, date, amount, bill, event, menu, CodeHall FROM orders";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "num: " . $row["num"] . " , Date: " . $row["date"] . " , Amount: " . $row["amount"] . " , event: " . $row["event"] . " , bill: " . $row["bill"] . " , menu: " . $row["menu"] . " , event: " . $row["event"] . " , CodeHall: " . $row["CodeHall"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'roles' :
						//print all the rows in roles
						$sql = "SELECT code, description FROM roles";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "Code: " . $row["code"] . " , Description: " . $row["description"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'servings' :
						//print all the rows in servings
						$sql = "SELECT code, name, description FROM servings";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "Code: " . $row["code"] . " , Name: " . $row["name"] . " , Description: " . $row["description"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'bills' :
						//print all the rows in servings
						$sql = "SELECT code, issueDate, lastDatePayment, money FROM bills";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "Code: " . $row["code"] . " , issueDate: " . $row["issueDate"] . " , last Date Payment: " . $row["lastDatePayment"] . " , money: " . $row["money"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'biggestEvent' :
						//print biggestEvent in orders
						$sql = "SELECT date, amount, num FROM orders ORDER BY amount DESC";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_assoc()) {
								echo "amount: " . $row["amount"] . " , date: " . $row["date"] . " , from OrderNum: " . $row["num"] . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'eventsByDate' :
						//print events By Date in orders
						$sql = "SELECT date, event, CodeHall FROM orders ORDER BY date DESC";

						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_object()) {
								$sql2 = "SELECT name FROM events WHERE code=$row->event";
								$result2 = $conn -> query($sql2) -> fetch_object();
								echo "date: " . $row -> date;
								echo " , event: " . $result2 -> name;
								echo " , in hall: " . $row -> CodeHall . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;

					case 'EventsPerHall' :
						//print events per Hall in orders
						$sql = "SELECT date, CodeHall ,event,COUNT('event') as c FROM orders GROUP BY bill";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_object()) {

								$sql2 = "SELECT name FROM halls WHERE CodeHall=$row->CodeHall";
								$result2 = $conn -> query($sql2) -> fetch_object();
								echo "hall: " . $result2 -> name;
								echo " , events: " . $row -> c . "<br>";
							}
						} else {
							echo "0 results";
						}
						break;
				}
			}

			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			////////////////////////////////////////////////////////////////////////////////ACTIONS////////////////////////////////////////////////////////
			/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
			if (isset($_REQUEST['information']) == TRUE) {
				switch($_REQUEST['information']) {

					case 'EmpHalls' :
						$sql = "SELECT num, event, CodeHall,employee FROM orders";
						$result = $conn -> query($sql);
						if ($result -> num_rows > 0) {
							// output data of each row
							while ($row = $result -> fetch_object()) {
								$emp = $row -> employee;
								$sql2 = "SELECT name FROM employees WHERE id=$emp";
								$sql3 = "SELECT CodeHall FROM halls WHERE CodeHall=$row->CodeHall ";
								$result2 = $conn -> query($sql2);
								$result3 = $conn -> query($sql3);
								if ($result3 -> num_rows > 0 && $result2 -> num_rows > 0)
									while ($row2 = $result2 -> fetch_object()) {
										echo "name:   " . $row2 -> name . ",  ";
										echo "CodeHall:   " . $result3 -> fetch_object() -> CodeHall . "<br>";
									}
							}
						} else {
							echo "0 results";
						}
						break;

					case 'Guests' :
						$newNumOfGuests = $_REQUEST["newNumOfGuests"];
						$NumOfOrder = $_REQUEST["NumOfOrder"];
						$sql = "UPDATE orders SET amount='$newNumOfGuests' WHERE num='$NumOfOrder'";
						$sql2 = $conn -> query("SELECT num,CodeHall FROM orders WHERE num = $NumOfOrder");
						
						if ($conn -> query($sql2) === TRUE) {
							$hall = $conn -> query($sql2) -> fetch_assoc();
							echo $hall["CodeHall"];
						}
						break;

					case 'MenuName' :
						$NumOfMenu1 = $_REQUEST["NumOfMenu1"];
						$newNameOfMenu = $_REQUEST["newNameOfMenu"];

						$sql = "UPDATE menus SET name='$newNameOfMenu' WHERE num='$NumOfMenu1'";
						if ($conn -> query($sql) === TRUE) {
							echo "Record updated successfully";
						} else {
							echo "Error updating record: " . $conn -> error . "<br>";
						}
						break;

					case 'MenuPrice' :
						$NumOfMenu = $_REQUEST["NumOfMenu"];
						$newPriceOfMenu = $_REQUEST["newPriceOfMenu"];

						$sql = "UPDATE menus SET price='$newPriceOfMenu' WHERE num='$NumOfMenu'";
						if ($conn -> query($sql) === TRUE) {
							echo "Record updated successfully";
						} else {
							echo "Error updating record: " . $conn -> error . "<br>";
						}
						break;

					case 'Order' :
						$DateOfEvent = $_REQUEST["DateOfEvent"];
						$NumOfPeople1 = $_REQUEST["NumOfPeople1"];
						$HallType = $_REQUEST["HallType"];
						$TypeEvent = $_REQUEST["TypeEvent"];
						$Code = $_REQUEST["Code"];

						$sql = "SELECT * FROM halls WHERE code = $Code";
						if (isset($conn -> query($sql) -> fetch_object() -> code))//if the code exists
						{
							echo "Code exists, Please try again another code <br>";
							return;
						}

						//ORDERS
						$sql = "INSERT INTO orders (num, date, amount) VALUES ('$Code', '$DateOfEvent', '$NumOfPeople1')";
						if ($conn -> query($sql) === TRUE) {
							echo "Record updated successfully in ORDERS" . "<br>";
						} else {
							echo "Error updating record: " . $conn -> error . "<br>";
						}
						//EVENTS
						$sql = "INSERT INTO events (code, name) VALUES ($Code, '$TypeEvent')";
						if ($conn -> query($sql) === TRUE) {
							echo "Record updated successfully in EVENTS" . "<br>";
						} else {
							echo "Error updating record: " . $conn -> error . "<br>";
						}
						//HALL
						$sql = "INSERT INTO halls (code, name, capacity) VALUES ($Code, '$HallType','$NumOfPeople1')";
						if ($conn -> query($sql) === TRUE) {
							echo "Record updated successfully in HALLS" . "<br>";
						} else {
							echo "Error updating record: " . $conn -> error . "<br>";
						}
						break;
				}
			}

			//close the connection
			$conn -> close();
			?>

			<nav>
				<div class="btn-group" role="group" aria-label="...">
					<ul>
						<li>
							<a href="index.html">
							<button type="button" class="btn btn-default" id="buttonLinks">
								Back to Main
							</button></a>
						</li>

						<li>
							<a href="information.html">
							<button type="button" class="btn btn-default" id="buttonLinks">
								Information
							</button></a>
						</li>

						<li>
							<a href="insert.html">
							<button type="button" class="btn btn-default" id="buttonLinks">
								Insert
							</button></a>
						</li>

						<li>
							<a href="actions.html">
							<button type="button" class="btn btn-default" id="buttonLinks">
								Actions
							</button></a>
						</li>
					</ul>

				</div>
			</nav>
		</div>
	</body>
</html>