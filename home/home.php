<?php
	$conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   if ($conn->connect_error)  {
      echo "Unable to connect to database";
      exit;
   }

   if(isset($_POST["inputUserName"])) {
      $name = $_POST["inputUserName"];
      $email = $_POST["inputEmail"];
      $password = hash('sha256', $_POST["Password"]);

   //print($name."<br />".$email."<br />".$password);

      $query = "INSERT into users(userName, userEmail, userPass) VALUES('$name','$email','$password')";
      $result = $conn->query($query);
      if($result) {
         print("<h1>Success! Welcome ".$name."!</h1>");
      } else
         print("<h1>Something went wrong...</h1>");

   } else {
      $email = $_POST["inputEmail"];

      $query = "SELECT userID, userName from users where userEmail = \"".$email."\"";
      $result = $conn->query($query);
      $result->data_seek(0);
      while ($row = $result->fetch_assoc()) {
         $name = $row["userName"];
         $iD = $row["userID"];
      }
      print("<h1>Welcome ".$name."</h1>");
   }

   $conn->close();
?>