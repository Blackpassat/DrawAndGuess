<?php
	session_start();
	$statusinfo = "";
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}
   	$query = "SELECT roomId from gameuser where userId = \"".$_SESSION["userId"]."\"";
   	$result = $conn->query($query);
   	$result->data_seek(0);
   	while ($row = $result->fetch_assoc()) {
   		$query1 = "SELECT roomName, status from gameroom WHERE roomId = \"".$row["roomId"]."\"";
   		$result1 = $conn->query($query1);
   		$result1->data_seek(0);
   		while($row1 = $result1->fetch_assoc()) {
   			if($row1["status"] == 'F') {
   				$statusinfo = "<span class=\"text-success\">available</span>";
   				print("<div class=\"col-xs-6 col-sm-3 placeholder\"><a href=\"../drawing/gameRoom.php?roomId=".$row["roomId"]."&userId=".$_SESSION["userId"]."&userName=".$_SESSION["userName"]."\"><img src=\"./image/".rand(1,100).".png\" width=\"100\" height=\"100\" class=\"img-responsive\" alt=\"Generic placeholder thumbnail\"><h4>".$row1["roomName"]."</h4>".$statusinfo."</a></div>");
   			}
   			else {
   				$statusinfo = "<span class=\"text-danger\">started</span>";
   				print("<div class=\"col-xs-6 col-sm-3 placeholder\"><img src=\"./image/".rand(1,100).".png\" width=\"100\" height=\"100\" class=\"img-responsive\" alt=\"Generic placeholder thumbnail\"><h4>".$row1["roomName"]."</h4>".$statusinfo."</div>");
   			}
   		}
   	}
   	if($statusinfo == "")
   		print("<h3>No room now. You can create One!</h3>")

	
?>	
