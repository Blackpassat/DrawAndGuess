<?php
	session_start();
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

	if(isset($_GET["email"])) {
		
		$query = "select userId, userName, status from users where userEmail = \"".$_GET["email"]."\"";
		$result = $conn->query($query);
		$result->data_seek(0);
			
		while ($row = $result->fetch_assoc()) {
			$id = $row["userId"];
			$name = $row["userName"];
			$status = $row["status"];
		}
		$tableRow1 = "<tbody><tr><td style=\"vertical-align:middle;\">";
	    $tableRow2 = "</td><td style=\"vertical-align:middle;\">";
	    $tableRow3 = "</td></tr></tbody>";
	    
	    if(isset($name)) {
	    	$button = "<button type=\"button\" class=\"btn btn-info btn-sm\" onclick=\"addFriend(".$id.")\" style=\"width:100%\">Add</button>";
	    	if($_SESSION["userEmail"] == $_GET["email"]) 
	    		print("<h4>You cannot add yourself as friend!</h4>");
	    	else {
	    		if($status == 'T') 
	    			$statusInfo = "<td class=\"success\" style=\"vertical-align:middle;\">online</td>";
	    		else
	    			$statusInfo = "<td class=\"danger\" style=\"vertical-align:middle;\">offline</td>";
	    		print($tableRow1.$name.$tableRow2.$_GET["email"].$tableRow2.$statusInfo.$tableRow2.$button."</td><td id=\"".$id."\">".$tableRow3);
	    	}
	    } else {
	    	print("<h4>User not found!</h4>");
	    	exit;
	    }
	    	
	}

	if(isset($_GET["name"])) {
		$query = "SELECT userId, userName, status, userEmail from users where userName = \"".$_GET["name"]."\"  and userId <> \"".$_SESSION["userId"]."\"";
		$result = $conn->query($query);
		$result->data_seek(0);
		$statusInfo = "";
		while ($row = $result->fetch_assoc()) {
			if($row["status"] == 'T') 
	    			$statusInfo = "<td class=\"success\" style=\"vertical-align:middle;\">online</td>";
	    		else
	    			$statusInfo = "<td class=\"danger\" style=\"vertical-align:middle;\">offline</td>";
			print("<tr><td style=\"vertical-align:middle;\">".$row["userName"]."</td><td style=\"vertical-align:middle;\">".$row["userEmail"]."</td>".$statusInfo."<td><button type=\"button\" onclick=\"addFriend(".$row["userId"].")\" class=\"btn btn-info btn-sm\"  style=\"width:100%\">Add</button></td>"."<td style=\"vertical-align:middle;\" id=\"".$row["userId"]."\"></td>"."</tr>");		
		}
		if($statusInfo == "") {
			print("<h4>User not found!</h4>");
			exit;
		}
	}
		
	$conn->close();
?>