<?php
	session_start();
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}

	if(isset($_GET["email"])) {
		
		$query = "select userName, status from users where userEmail = \"".$_GET["email"]."\"";
		$result = $conn->query($query);
		$result->data_seek(0);
			
		while ($row = $result->fetch_assoc()) {
			$name = $row["userName"];
			$status = $row["status"];
		}
		$tableRow1 = "<tbody><tr><td>";
	    $tableRow2 = "</td><td>";
	    $tableRow3 = "</td></tr></tbody>";
	    if(isset($name)) {
	    	if($_SESSION["userEmail"] == $_GET["email"]) 
	    		print("<h4>You cannot add yourself as friend!</h4>");
	    	else {
	    		if($status == 'T') 
	    			$statusInfo = "<td class=\"success\">online</td>";
	    		else
	    			$statusInfo = "<td class=\"danger\">offline</td>";
	    		print($tableRow1.$name.$tableRow2.$_GET["email"].$tableRow2.$statusInfo.$tableRow3);
	    	}
	    } else {
	    	print("<h4>User not found!</h4>");
	    	exit;
	    }
	    	
	}

	if(isset($_GET["name"])) {
		$query = "SELECT userName, status, userEmail from users where userName = \"".$_GET["name"]."\"  and userId <> \"".$_SESSION["userId"]."\"";
		$result = $conn->query($query);
		$result->data_seek(0);
		$statusInfo = "";
		while ($row = $result->fetch_assoc()) {
			if($row["status"] == 'T') 
	    			$statusInfo = "<td class=\"success\">online</td>";
	    		else
	    			$statusInfo = "<td class=\"danger\">offline</td>";
			print("<tr><td>".$row["userName"]."</td><td>".$row["userEmail"]."</td>".$statusInfo."</tr>");		
		}
		if($statusInfo == "") {
			print("<h4>User not found!</h4>");
			exit;
		}
	}
		
	$conn->close();
?>