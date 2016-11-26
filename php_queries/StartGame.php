<?php

	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$updateRoomStatus = false;
	$roomId = $_GET["roomId"];  

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	$query = "SELECT count(userId) from gameuser where roomId = \"".$roomId."\" and status = 'T'";
   	$result = $conn->query($query);
   	if(!$result) 
   		$errorType = 2;
   	else {
   		$result->data_seek(0);
   		while ($row = $result->fetch_assoc()) {
   			$count = $row["count(userId)"];
   	}
   	}

   	if($count < 2)
   		$errorType = 1;
  	else {
   		$query = "UPDATE gameroom set status = 'T' where roomId = \"".$roomId."\"";
   		$result = $conn->query($query);
   		if(!$result)
   			$errorType = 2;
   		else
   			$updateRoomStatus = true;
   	}


   	if($success)
   		echo "success";
   	elseif ($errorType == 1)
   		echo "Not enough players to start game!";
   	else 
   		echo "Something is wrong with database!";

   	$conn->close();
	
?>