<?php
	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$roomId = $_GET["roomId"];
	$userId = $_GET["userId"];

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	$query = "UPDATE gameuser set status = 'F' where roomId = \"".$roomId."\" and userId = \"".$userId."\"";
   	$result = $conn->query($query);
   	if(!$result)
   		$errorType = 1;

   	if(isset($errorType))
   		print("Something is wrong with database!");
	$conn->close();
?>