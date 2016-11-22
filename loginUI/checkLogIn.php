<?php
	$email = $_POST["email"];
   $pwd = hash('sha256', $_POST["pwd"]);

	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}
   	$query = "SELECT count(userEmail), userID, userName, userPass from users where userEmail = \"".$email."\"";
   	$result = $conn->query($query);
   	$result->data_seek(0);
   	while ($row = $result->fetch_assoc()) {
   		$pwdData = $row["userPass"];
         $count = $row["count(userEmail)"];
   	}
      if($count == 0) 
         $error = 1;
      else if($pwdData != $pwd)
         $error = 2;
      else
         $error = 0;

      print($error);
      //print($pwdData."<br/>".$pwd);
	$conn->close();

?>