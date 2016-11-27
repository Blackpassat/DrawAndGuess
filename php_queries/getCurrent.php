<?php
	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$roomId = $_GET["roomId"];


	$parameters = array();


	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	  $query = "SELECT currentUserId, questionId from gameroom where roomId = \"".$roomId."\"";
      $result = $conn->query($query);
      if(!$result) 
         $errorType = 1;
      else {
         $result->data_seek(0);
         while ($row = $result->fetch_assoc()) {
            $userId = $row["currentUserId"];
            $questionId = $row["questionId"];
         }
      }

   		$query = "SELECT userName from users where userId = \"".$userId."\"";
   		$result = $conn->query($query);
	   	if(!$result) 
	   		$errorType = 9;
	   	else {
	   		$result->data_seek(0);
	   		while ($row = $result->fetch_assoc()) {
	   			$userName = $row["userName"];
	   	}
	   }
	   	
	   	$query = "SELECT QuestionContent from gamequestions where QuestionID = \"".$questionId."\"";
	   	$result = $conn->query($query);
	   	if(!$result) 
	   		$errorType = 10;
	   	else {
	   		$result->data_seek(0);
	   		while ($row = $result->fetch_assoc()) {
	   			$content = $row["QuestionContent"];
	   		}   	
   		}
   		array_push($parameters, $userId);
   		array_push($parameters, $userName);
   		array_push($parameters, $content);

   if (isset($errorType)) {
   		if ($errorType == 1) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 2) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 3) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 4) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 5) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 6) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 7) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 8) {
   			print("Something is wrong with database ".$errorType."!");
   		} elseif ($errorType == 9) {
   			print("Something is wrong with database ".$errorType."!");
   		} else {
   			print("Something is wrong with database ".$errorType."!");
   		}
   	} 

   $conn->close();

   //sleep(2);

   echo json_encode($parameters);

?>