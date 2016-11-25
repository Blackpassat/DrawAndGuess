<?php
	session_start();

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

   	if(!isset($_GET["status"])) {
   		$id = $_GET["id"];
	$exist = true;
   	//print($_GET["id"]."	".$_SESSION["userId"]);
   	if($id < $_SESSION["userId"]) 
   		$query = "SELECT status, count(status) from relationship where user_one_id = \"".$id."\" and user_two_id = \"".$_SESSION["userId"]."\"";
   	else
   		$query = "SELECT status, count(status) from relationship where user_one_id = \"".$_SESSION["userId"]."\" and user_two_id = \"".$id."\"";
   	$result = $conn->query($query);
   	$result->data_seek(0);
   	while ($row = $result->fetch_assoc()) {
   		$count = $row["count(status)"];
   		$status = $row["status"];
   	}
   	if($count == 0 || $status == 2) {
   		$exist = false;
   	} else {
		if($status == 0)
   			print("<span class=\"text-warning\">You two are already friends, please check your friend list.</span>");
   		else if($status == 1)
   			print("<span class=\"text-warning\">The request is still pending, please wait for response.</span>");
   	}

   	if(!$exist) {
   		if($id < $_SESSION["userId"]) 
   			$query = "INSERT INTO 	relationship(user_one_id, user_two_id, status, action_user_id) VALUES (\"".$id."\", \"".$_SESSION["userId"]."\", 1, \"".$_SESSION["userId"]."\")";
   		else
   			$query = "INSERT INTO 	relationship(user_one_id, user_two_id, status, action_user_id) VALUES (\"".$_SESSION["userId"]."\", \"".$id."\", 1, \"".$_SESSION["userId"]."\")";
   		$result = $conn->query($query);
   		if($result)
   			print("<span class=\"text-success\">Your request has been sent.</span>");
   		else
   			print("<span class=\"text-danger\">Something is wrong, please try again later.</span>");
   	}
   } else {
   	if($_GET["id"] < $_SESSION["userId"]) {
   		$query = "UPDATE relationship set status = \"".$_GET["status"]."\" where action_user_id=\"".$_GET["id"]."\" and user_two_id = \"".$_SESSION["userId"]."\"";
   		$result = $conn->query($query);
   		if($result)
   			print("<span class=\"text-success\">Your response has been sent.</span>");
   		else
   			print("<span class=\"text-danger\">Something is wrong, please try again later.</span>");
   	} else {
   		$query = "UPDATE relationship set status = \"".$_GET["status"]."\" where action_user_id=\"".$_GET["id"]."\" and user_one_id = \"".$_SESSION["userId"]."\"";
   		$result = $conn->query($query);
   		if($result)
   			print("<span class=\"text-success\">Your response has been sent.</span>");
   		else
   			print("<span class=\"text-danger\">Something is wrong, please try again later.</span>");
   	}
   	
   }	

   	$conn->close();
?>