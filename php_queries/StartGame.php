<?php

	header('content-type:application:json;charset=utf8');  
	header('Access-Control-Allow-Origin:*');  
	header('Access-Control-Allow-Methods:POST');  
	header('Access-Control-Allow-Methods:GET');  
	header('Access-Control-Allow-Headers:x-requested-with,content-type');  

	
	$roomId = $_GET["roomId"];  

   $name = array();
   $id = array();
   $exist = true;
   $updateRoomStatus = false;

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

      if($userId == 0) {
      $query = "SELECT userId from gameuser where roomId = \"".$roomId."\" and status = 'T'";
      $result = $conn->query($query);
      if(!$result)
         $errorType = 2;
      else {
         $result->data_seek(0);
         while ($row = $result->fetch_assoc()) {
            
            $query1 = "SELECT userName from users where userId = \"".$row["userId"]."\"";
            $result1 = $conn->query($query1);
            if(!$result1)
               $errorType = 3;
            else {
               $result1->data_seek(0);
               while ($row1 = $result1->fetch_assoc()) {
                  array_push($name, $row1["userName"]);
                  array_push($id, $row["userId"]);
               }
            }
         }
      }

      while ($exist) {
         $questionId = rand(0,899);
         $query = "SELECT count(questionId) from roomquestion where roomId = \"".$roomId."\" and questionId = \"".$questionId."\"";
         $result = $conn->query($query);
         if(!$result) 
            $errorType = 4;
         else {
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
               $count = $row["count(questionId)"];
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
         $errorType = 5;


      $query = "INSERT INTO roomquestion(roomId, questionId) VALUES (\"".$roomId."\",\"".$questionId."\")";
      $result = $conn->query($query);
    if(!$result) 
      $errorType = 6;
    else {
      $query = "SELECT QuestionContent from gamequestions where QuestionID = \"".$questionId."\"";
      $result = $conn->query($query);
         if(!$result) 
            $errorType = 7;
         else {
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
               $content = $row["QuestionContent"];
            }
         }
    }

    $query = "UPDATE gameroom set currentUserId = \"".$id[0]."\" where roomId = \"".$roomId."\"";
         $result = $conn->query($query);
         if(!$result) 
            $errorType = 8; 
      }


   	if($updateRoomStatus)
   		echo "success";
   	elseif ($errorType == 1)
   		echo "Not enough players to start game!";
   	else 
   		echo "Something is wrong with database!";

   	$conn->close();


	
?>