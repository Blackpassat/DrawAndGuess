<?php
	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$guess = $_GET["guess"];
	$userId = $_GET["userId"];
	$roomId = $_GET["roomId"];

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	$query = "SELECT questionId from gameroom where roomId = \"".$roomId."\"";
   	$result = $conn->query($query);
   	if(!$result) 
   		$errorType = 4;
   	else {
   		$result->data_seek(0);
   		while ($row = $result->fetch_assoc()) {
   			$questionId = $row["questionId"];
   		}
   	}

   	$query = "SELECT count(QuestionID) from gamequestions where $questionID = \"".$questionId."\" and QuestionContent = \"".$guess."\"";
   	$result = $conn->query($query);
   	if(!$result) 
   		$errorType = 1;
   	else {
   		$result->data_seek(0);
   		while ($row = $result->fetch_assoc()) {
   			$count = $row["count(userId)"];
   		}
   	}

   	if($count == 1) {
   		$query = "UPDATE gameuser set win = win + 1 where roomId = \"".$roomId."\" and userId = \"".$userId."\"";
   		$result = $conn->query($query);
   		if(!$result)
   			$errorType = 2;
   		else
   			echo "correct";
   	}
   	else {
   		$query = "UPDATE gameuser set lose = lose + 1 where roomId = \"".$roomId."\" and userId = \"".$userId."\"";
   		$result = $conn->query($query);
   		if(!$result)
   			$errorType = 3;
   		else
   			echo "wrong";
   	}

   	if (isset($errorType)) {
   		if ($errorType == 1) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 2) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 3) {
   			print("Something is wrong with database ".$errorType."!");
   		} else {
   			print("Something is wrong with database ".$errorType."!");
   		}
   	} 

	/*sleep(2);
	echo "correct";*/
	$conn->close();
?>