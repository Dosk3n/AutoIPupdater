<?php
	// attributes to get are ip / name / code
	//error_reporting(E_ERROR | E_PARSE);
	$servername = "";
	$username = "";
	$password = "";
	$dbname = "";
	$dt = new DateTime('- 1 hour'); // To make it match UK
	$cur_time = $dt->format('H:i:s d/m/Y');
	echo $cur_time;
	
	if(isset($_GET['code']) && isset($_GET['name']) && isset($_SERVER['REMOTE_ADDR'])){
		try{
			$ip_address = $_SERVER['REMOTE_ADDR'];
			
			$conn = new mysqli($servername, $username, $password, $dbname);
			if ($conn->connect_error) {
				die("");
			}
			
			$name = mysqli_real_escape_string($conn, $_GET['name']);
			$code = mysqli_real_escape_string($conn, $_GET['code']);
			
			
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
					
					// SECURE OUR INPUT
					
					
					$sql = "UPDATE ip_addresses SET ip = '" . $ip_address . "', name = '" . $name . "', last_updated = '" . $cur_time . "' WHERE code = '" . $code . "'";
					
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