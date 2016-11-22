<?php
	$email = $_GET["email"];

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}
   	$query = "select count(userEmail) from users where userEmail = \"".$email."\"";
   	$result = $conn->query($query);
   	$result->data_seek(0);
   	while ($row = $result->fetch_assoc()) {
   		$count = $row["count(userEmail)"];
   	}
   	if($count != 0) {
   		print("error");
   	} else
   		print("success");

	$conn->close();

?>