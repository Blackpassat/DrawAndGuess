<?php
      $conn = mysqli_connect("localhost", "root", "123456","GAME_ROOM", "80", "/tmp/mysql.sock");
      if ($conn->connect_error)  {
         echo "Unable to connect to database";
          exit;
      }       

      $query = "select QuestionContentID QuestionContent from GameQuestions";
  
      $result = $conn->query($query);

      $result->data_seek(0);
      while ($row = $result->fetch_assoc())  {
        echo "<h5>" . "ID: " . $row["QuestionContentID"] . "Content: " . $row["QuestionContent"]  ."</h5>";
      }
 
      $result->free();
      $conn->close();

?>