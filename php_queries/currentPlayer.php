<?php

	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	$isFirstUser = $_GET["isFirstUser"];
	$roomId = $_GET["roomId"];
	
	$name = array();
	$parameters = array();
	$id = array();
	$exist = true;

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	$query = "SELECT userId from gameuser where roomId = \"".$roomId."\" and status = 'T'";
   	$result = $conn->query($query);
   	if(!$result)
   		$errorType = 1;
   	else {
   		$result->data_seek(0);
   		while ($row = $result->fetch_assoc()) {
   			array_push($id, $row["userId"]);
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

   	while ($exist) {
   		$questionId = rand(0,899);
	   	$query = "SELECT count(questionId) from roomquestion where roomId = \"".$roomId."\" and questionId = \"".$questionId."\"";
	   	$result = $conn->query($query);
	   	if(!$result) 
	   		$errorType = 3;
	   	else {
	   		$result->data_seek(0);
	   		while ($row = $result->fetch_assoc()) {
	   			$count = $row["count(userId)"];
	   		}
	   	}
	   	if($count > 0)
	   		$exist = true;
	   	else
	   		$exist = false;
   	}

   	$query = "UPDATE gameroom set questionId = \"".$questionId."\" where roomId = \"".$roomId."\"";
   	$result = $conn->query($query);
   	if(!$result)
   		$errorType = 9;


   	$query = "INSERT INTO roomquestion(roomId, questionId) VALUES (\"".$roomId."\",\"".$questionId."\")";
   	$result = $conn->query($query);
    if(!$result) 
    	$errorType = 4;
    else {
    	$query = "SELECT QuestionContent from gamequestions where QuestionID = \"".$questionId."\"";
    	$result = $conn->query($query);
	   	if(!$result) 
	   		$errorType = 5;
	   	else {
	   		$result->data_seek(0);
	   		while ($row = $result->fetch_assoc()) {
	   			$content = $row["QuestionContent"];
	   		}
	   	}
    } 	

   	if($isFirstUser) {
   		$query = "UPDATE gameroom set currentUserId = \"".$id[0]."\" where roomId = \"".$roomId."\"";
   		$result = $conn->query($query);
   		if(!$result) 
   			$errorType = 6;
   		else {
   			array_push($parameters, $id[0]);
   			array_push($parameters, $name[0]);
   			array_push($parameters, $content);
   		}  		
   	} else {
   		$query = "SELECT currentUserId from gameroom where roomId = \"".$roomId."\"";
   		$result = $conn->query($query);
   		if(!$result)
   			$errorType = 7;
   		else {
   			$result->data_seek(0);
   			while ($row = $result->fetch_assoc()) {
   				$currentId = $row["currentUserId"];
   			}
   			for ($i=0; $i < sizeof($id); $i++) { 
   				if($currentId == $id[$i])
   					$idNo = $i;
   			}
   			if($idNo != sizeof($id)-1) {
   				$query1 = "UPDATE gameroom set currentUserId = \"".$id[$idNo+1]."\" where roomId = \"".$roomId."\"";
   				$result1 = $conn->query($query);
   				if(!$result)
   					$errorType = 8;
   				else {
   					array_push($parameters, $id[$idNo+1]);
   					array_push($parameters, $name[$idNo+1]);
   					array_push($parameters, $content);
   				}
   			} else {
   				array_push($parameters, null);
   			}
   		}	
   		
   	}

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
   		} else {
   			print("Something is wrong with database ".$errorType."!");
   		}
   	} 

   	$conn->close();
	//sleep(2);
	// array{nextUserID, nextUserName, questionContent}
	// *When game is over, set nextUserID to null
	//$parameters = array("12345", "YiSha", "pirate of the caribbean");
	echo json_encode($parameters);
?>