<?php
	session_start();
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   	if ($conn->connect_error)  {
		echo "Unable to connect to database";
   		exit;
   	}
	if (isset($_GET['logout'])) {
	  $query = "UPDATE users set status = 'F' WHERE userId = \"".$_SESSION['userId']."\"";
      $result = $conn->query($query);
	  unset($_SESSION['userName']);
	  unset($_SESSION['userId']);
	  unset($_SESSION['userEmail']);
	  session_unset();
	  session_destroy();
	  header("Location: ../loginUI/login.php");
	  exit;
 	}
 	$conn->close();
?>