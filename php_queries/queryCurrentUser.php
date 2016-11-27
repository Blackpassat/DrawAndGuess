<?php

	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$name = array();
   $roomId = $_GET["roomId"];

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	$query = "SELECT userId from gameuser where roomId = \"".$roomId."\" and status = 'T'";
   	$result = $conn->query($query);
   	if(!$result) {
   		$errorType = 1;
   	}
   	else {
   		$result->data_seek(0);
   		while ($row = $result->fetch_assoc()) {
   			$query1 = "SELECT userName from users where userId = \"".$row["userId"]."\"";
   			$result1 = $conn->query($query1);
   			if(!$result1)
   				$errorType = 2;
   			else {
   				$result1->data_seek(0);
   				while ($row1 = $result1->fetch_assoc()) {
   					array_push($name, $row1["userName"]);
   				}
   			}
   		}
   	}

   	if (isset($errorType)) {
   		if ($errorType == 1) {
   			print("Something is wrong with database 1!");
   		} else {
   			print("Something is wrong with database 2!");
   		}   		
   	} 
   	$conn->close();

	// array{userName, userName}
	//$id_numbers = array("Spark", "Raymond", "Yisha", "Joshua", "Aaron");
	echo json_encode($name);
?>