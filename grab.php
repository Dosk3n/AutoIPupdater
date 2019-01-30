<?php
	// attributes to get are ip / name / code
	error_reporting(E_ERROR | E_PARSE);
	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";
	
	if(isset($_GET['code']) && isset($_GET['name']) && isset($_SERVER['REMOTE_ADDR'])){
		try{
			$ip_address = $_SERVER['REMOTE_ADDR'];
			$name = $_GET['name'];
			$code = $_GET['code'];
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("");
			}
			
			$sql = "SELECT * FROM ip_addresses WHERE code = '" . $code . "'";
			$result = $conn->query($sql);

			$rows = [];
			if (isset($result->num_rows) > 0) {
				// output data of each row
				while($row = $result->fetch_assoc()) {
					array_push($rows, $row);
				}
				
				// At this point we have confirmed that there is a result for that code
				// so we can do an insert with the IP that was sent.
				try{
					
					$conn2 = new mysqli($servername, $username, $password, $dbname);
					if ($conn2->connect_error) {
						die("");
					}
					$sql = "UPDATE ip_addresses SET ip = '" . $ip_address . "', name = '" . $name . "' WHERE code = '" . $code . "'";
					
					if ($conn2->query($sql) === TRUE) {
						echo "";
					} else {
						echo "";
					}

					if(isset($conn)){
						$conn->close();
					}
					
				} catch(Exception $e){
					echo "";
					if(isset($conn2)){
						$conn->close();
					}
				}
				
			} else {
				echo "";
			}
			if(isset($conn)){
				$conn->close();
			}
		} catch(Exception $e){
			
			echo "";
			if(isset($conn)){
				$conn->close();
			}
			
		}
		
	}
		
	
	
	




?>