<?php
	session_start();
	$error = false;
	$size = sizeof($_GET["selectedFriend"]);
	$roomId = uniqid();
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}
   	$query = "INSERT INTO gameroom(roomId, roomName, status, currentUserId) VALUES (\"".$roomId."\",\"".$_GET["roomName"]."\", 'F','0')";
   	$result = $conn->query($query);
   	if(!$result)
   		$error = true;
   	$query = "INSERT INTO gameuser(roomId, userId) VALUES (\"".$roomId."\",\"".$_SESSION["userId"]."\")";
   	$result = $conn->query($query);
   	if(!$result)
   		$error = true;
   	for ($i=0; $i < $size; $i++) { 
   		$query = "INSERT INTO gameuser(roomId, userId) VALUES (\"".$roomId."\",\"".$_GET["selectedFriend"][$i]."\")";
   		$result = $conn->query($query);
   		if(!$result)
   			$error = true;
   	}
   	$conn->close();
   	if($error)
   		print("<h3>Something is wrong, please try again later.</h3>");
   	else
   		header("Location: ../drawing/gameRoom.php?roomId=".$roomId."&userId=".$_SESSION["userId"]."&userName=".$_SESSION["userName"]);
?>