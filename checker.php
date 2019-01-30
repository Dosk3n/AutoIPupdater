<?php
	// script to get an IP back based on name
	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";

	if(isset($_GET['name'])){
	
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn->connect_error) {
			die("");
		}
		
		// SECURE OUR INPUT
		$name = mysqli_real_escape_string($conn, $_GET['name']);
		$sql = "SELECT ip FROM ip_addresses WHERE name = '" . $name . "'";
		$result = $conn->query($sql);
		if (isset($result->num_rows) > 0) {
			
			while($row = $result->fetch_assoc()) {
					echo $row["ip"];
				}
			
		}
	}


?>