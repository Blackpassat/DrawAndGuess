<?php
	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$roomId = $_GET["roomId"];

	$params = array();

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	$query = "SELECT userId, win from gameuser where roomId = \"".$roomId." and status = 'T'\"";
   	$result = $conn->query($query);
   	if(!$result) 
   		$errorType = 1;
   	else {
   		$result->data_seek(0);
   		while ($row = $result->fetch_assoc()) {
   			array_push($params, $row["userId"]);
   			array_push($params, $row["win"]);
   			$query1 = "UPDATE gameuser set win = \"".$row["win"]."\" where userId = \"".$row["userId"]."\"";
   			$result1 = $conn->query($query1);
   			if(!$result1) 
   				$errorType = 2;
   	} 

   	if (isset($errorType)) {
   		if ($errorType == 1) {
   			print("Something is wrong with database ".$errorType."!");
   		} else {
   			print("Something is wrong with database ".$errorType."!");
   		}
   	} 

   	$conn->close();

   	echo json_encode($params);
?>