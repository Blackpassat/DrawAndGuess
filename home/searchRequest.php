<?php
	session_start();
	
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}
   	if($_GET["mode"] == 0) {
	$exist1 = false;
	$exist2 = false;
   	$query = "SELECT user_one_id from relationship where user_two_id = \"".$_SESSION["userId"]."\" and status = '1' and action_user_id <> \"".$_SESSION["userId"]."\" and status = '1'";
   	$result = $conn->query($query);
   	$result->data_seek(0);
   	if(!$result) {
   	} else {
   		while ($row = $result->fetch_assoc()) {
   			$query1 = "SELECT userName, userEmail from users where userId = \"".$row["user_one_id"]."\"";
   			$result1 = $conn->query($query1);
   			$result1->data_seek(0);
   			while($row1 = $result1->fetch_assoc()) {
   				print("<tr><td style=\"vertical-align:middle;\">".$row1["userName"]."</td><td style=\"vertical-align:middle;\">".$row1["userEmail"]."</td><td>"."<button type=\"button\" onclick=\"friendRequest(".$row["user_one_id"].", 0)\" class=\"btn btn-success btn-sm\"  style=\"width:50%\">Accept</button><button type=\"button\" onclick=\"friendRequest(".$row["user_one_id"].", 2)\" class=\"btn btn-danger btn-sm\"  style=\"width:50%\">Decline</button></td><td style=\"vertical-align:middle;\" id=\"".$row["user_one_id"]."\">"."</td></tr>");
   			}
   			$exist1 = true;
   		}
   	}

   	$query = "SELECT user_two_id from relationship where user_one_id = \"".$_SESSION["userId"]."\" and status = '1' and action_user_id <> \"".$_SESSION["userId"]."\" and status = '1'";
   	$result = $conn->query($query);
   	$result->data_seek(0);
   	if(!$result) {
   	} else {
   		while ($row = $result->fetch_assoc()) {
   			$query1 = "SELECT userName, userEmail from users where userId = \"".$row["user_two_id"]."\"";
   			$result1 = $conn->query($query1);
   			$result1->data_seek(0);
   			while($row1 = $result1->fetch_assoc()) {
   				print("<tr><td style=\"vertical-align:middle;\">".$row1["userName"]."</td><td style=\"vertical-align:middle;\">".$row1["userEmail"]."</td><td>"."<button type=\"button\" onclick=\"friendRequest(".$row["user_two_id"].", 0)\" class=\"btn btn-success btn-sm\"  style=\"width:50%\">Accept</button><button type=\"button\" onclick=\"friendRequest(".$row["user_two_id"].", 2)\" class=\"btn btn-danger btn-sm\"  style=\"width:50%\">Decline</button></td><td style=\"vertical-align:middle;\" id=\"".$row["user_two_id"]."\">"."</td></tr>");
   			}
   			$exist2 = true;
   		}
   	}

   	if($exist1 == false && $exist2 == false)
   		print("<h4>No request.</h4>");
	} else if($_GET["mode"] == 1) {
		$statusInfo = "";
		$query = "SELECT user_one_id, user_two_id from relationship where action_user_id = \"".$_SESSION["userId"]."\" and status = '1'";
		$result = $conn->query($query);
		$result->data_seek(0);
		if(!$result) {
			print("<h4>No request.</h4>");
		} else {
			while ($row = $result->fetch_assoc()) {
				if($_SESSION["userId"] == $row["user_one_id"]) {
					$query1 = "SELECT userName, userEmail, status from users where userId = \"".$row["user_two_id"]."\" group by userName";
					$result1 = $conn->query($query1);
   					$result1->data_seek(0);
   					while($row1 = $result1->fetch_assoc()) {
   						if($row1["status"] == 'T') 
	    					$statusInfo = "<td class=\"success\" style=\"vertical-align:middle;\">online</td>";
	    				else
	    					$statusInfo = "<td class=\"danger\" style=\"vertical-align:middle;\">offline</td>";
   						print("<tr><td>".$row1["userName"]."</td><td>".$row1["userEmail"]."</td>".$statusInfo."</tr>");
   					}
				} else {
					$query1 = "SELECT userName, userEmail, status from users where userId = \"".$row["user_one_id"]."\" group by userName";
					$result1 = $conn->query($query1);
   					$result1->data_seek(0);
   					while($row1 = $result1->fetch_assoc()) {
   						if($row1["status"] == 'T') 
	    					$statusInfo = "<td class=\"success\" style=\"vertical-align:middle;\">online</td>";
	    				else
	    					$statusInfo = "<td class=\"danger\" style=\"vertical-align:middle;\">offline</td>";
   						print("<tr><td>".$row1["userName"]."</td><td>".$row1["userEmail"]."</td>".$statusInfo."</tr>");
				}

			}
		}
	} 
	if($statusInfo == "") {
		print("<h4>No request.</h4>");
	}
} else {
	$statusInfo = "";
		$query = "SELECT user_one_id, user_two_id from relationship where action_user_id = \"".$_SESSION["userId"]."\" and status = '2'";
		$result = $conn->query($query);
		$result->data_seek(0);
		if(!$result) {
			print("<h4>No request.</h4>");
		} else {
			while ($row = $result->fetch_assoc()) {
				if($_SESSION["userId"] == $row["user_one_id"]) {
					$query1 = "SELECT userName, userEmail, status from users where userId = \"".$row["user_two_id"]."\" group by userName";
					$result1 = $conn->query($query1);
   					$result1->data_seek(0);
   					while($row1 = $result1->fetch_assoc()) {
   						if($row1["status"] == 'T') 
	    					$statusInfo = "<td class=\"success\" style=\"vertical-align:middle;\">online</td>";
	    				else
	    					$statusInfo = "<td class=\"danger\" style=\"vertical-align:middle;\">offline</td>";
   						print("<tr><td>".$row1["userName"]."</td><td>".$row1["userEmail"]."</td>".$statusInfo."</tr>");
   					}
				} else {
					$query1 = "SELECT userName, userEmail, status from users where userId = \"".$row["user_one_id"]."\" group by userName";
					$result1 = $conn->query($query1);
   					$result1->data_seek(0);
   					while($row1 = $result1->fetch_assoc()) {
   						if($row1["status"] == 'T') 
	    					$statusInfo = "<td class=\"success\" style=\"vertical-align:middle;\">online</td>";
	    				else
	    					$statusInfo = "<td class=\"danger\" style=\"vertical-align:middle;\">offline</td>";
   						print("<tr><td>".$row1["userName"]."</td><td>".$row1["userEmail"]."</td>".$statusInfo."</tr>");
				}

			}
		}
	} 
	if($statusInfo == "") {
		print("<h4>No request.</h4>");
	}
}
	
   	$conn->close();
?>