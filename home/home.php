<?php
  session_start();
  $conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
   if ($conn->connect_error)  {
      echo "Unable to connect to database";
      exit;
   }

   if(isset($_POST["inputUserName"])) {
      $firstTime = false;
      $name = $_POST["inputUserName"];
      
      if(isset($_POST["inputEmail"])) {
        $email = $_POST["inputEmail"];
        $firstTime = true;
      }

      $password = hash('sha256', $_POST["Password"]);
      $success = false;

   //print($name."<br />".$email."<br />".$password);
      if($firstTime) {
        $query = "INSERT into users(userName, userEmail, userPass) VALUES('$name','$email','$password')";
        $result = $conn->query($query);
        if($result) {
          $success = true;
        } else {
          print("<h1>Something went wrong...</h1>");
          exit();
        }

        if($success) {
          $query = "SELECT userId from users where userEmail = \"".$email."\"";
          $result = $conn->query($query);
          $result->data_seek(0);
          while ($row = $result->fetch_assoc()) {
            $iD = $row["userId"];
          }
          $_SESSION["userEmail"] = $email;
          $_SESSION["userId"] = $iD;
          $query = "UPDATE users set status = 'T' WHERE userId = \"".$iD."\"";
          $result = $conn->query($query);
        }
      } else {
        $success = false;
        $email = $_POST["inputEmail2"];
        $query = "UPDATE users set userName = \"".$name."\", userPass = \"".$password."\" WHERE userEmail= \"".$email."\"";
        $result = $conn->query($query);
        if($result)
          $success = true;
        else {
          print("<h1>Something went wrong...</h1>");
          exit();
        }

        if($success) {
          $query = "SELECT userId from users where userEmail = \"".$email."\"";
          $result = $conn->query($query);
          $result->data_seek(0);
          while ($row = $result->fetch_assoc()) {
            $iD = $row["userId"];
          }
          $_SESSION["userId"] = $iD;
        }

      }        
        $_SESSION["userName"] = $name;
   } else {
      $email = $_POST["inputEmail"];

      $query = "SELECT userId, userName from users where userEmail = \"".$email."\"";
      $result = $conn->query($query);
      $result->data_seek(0);
      while ($row = $result->fetch_assoc()) {
         $name = $row["userName"];
         $iD = $row["userId"];
      }
      $_SESSION["userId"] = $iD;
      $_SESSION["userName"] = $name;
      $_SESSION["userEmail"] = $email;
      $query = "UPDATE users set status = 'T' WHERE userId = \"".$iD."\"";
      $result = $conn->query($query);
   }

   $conn->close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Dashboard Template for Bootstrap</title>

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

    <link rel="stylesheet" href="../bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css"/>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet"> -->

    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">

<!--     <link href="../UI-Dropdown-master/dropdown.css" rel="stylesheet">

    <link href="../UI-Dropdown-master/dropdown.min.css" rel="stylesheet" >

     <script src="../UI-Dropdown-master/dropdown.js"></script>

    <script src="../UI-Dropdown-master/dropdown.min.js"></script>

    <script src="../UI-Dropdown-master/index.js"></script>

    <script src="../UI-Dropdown-master/package.js"></script> -->

    <!-- <link href="../bootstrap/css/theme.css" rel="stylesheet"> -->

    <style type="text/css">
      white {
        color: white;
      }
      green {
        color: green;
      }
      gray {
        color: gray;
      }
      .table td {
        text-align: center;   
      }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

    <script src="../bootstrap/js/bootstrap.min.js"></script>

    <script src="../bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->
    <!-- <script src="../../assets/js/ie-emulation-modes-warning.js"></script> -->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script type="text/javascript">
      function check() {
        var pwd = document.getElementById("Password").value;
        var pwdConfirm = document.getElementById("inputPasswordConfirm").value;
        if(pwd == pwdConfirm) 
          return true;
        else {
          info.innerHTML = '<em> These two passwords are not match! </em>';
          document.getElementById("Password").value = "";
          document.getElementById("inputPasswordConfirm").value = "";
          return false;
        }
      }

      function searchEmail() {
        var email = document.getElementById("searchEmail").value;
        //var tableHead = "<thead><tr><th>Name</th><th>Email</th><th>Status</th></tr></thead>";
        if(email == "") {
          document.getElementById("searchEmailInfo").innerHTML = "<span class=\"text-danger\"><h4>Please fill something</h4></span>";
        } else {
          var xmlHttp;
          xmlHttp = new XMLHttpRequest();
          xmlHttp.onreadystatechange = function() {
            document.getElementById("searchEmailInfo").innerHTML = xmlHttp.responseText;
          }
          var url = "search.php?email="+email;
          xmlHttp.open("GET", url, true);
          xmlHttp.send(null);
        }
        
        // document.getElementById("searchEmailInfo").innerHTML = tableHead+tableRow1+"hehe"+tableRow2+email+tableRow3+"hehe"+tableRow4;
      }

      function searchName() {
        var name = document.getElementById("searchName").value;
        if(name == "") {
          document.getElementById("searchNameInfo").innerHTML = "<span class=\"text-danger\"><h4>Please fill something</h4></span>";
        } else {
        var xmlHttp;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
          document.getElementById("searchNameInfo").innerHTML = xmlHttp.responseText;
        }
        var url = "search.php?name="+name;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
      }
      }

      function addFriend(id) {
        // document.getElementById(id).innerHTML = id;
        var xmlHttp;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
          document.getElementById(id).innerHTML = xmlHttp.responseText;
        }
        var url = "addfriend.php?id="+id;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
      }

      function checkInbox(mode) {
        //document.getElementById("searchFriendRequest").innerHTML = "haha";
        var xmlHttp;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
          if(mode == 0)
            document.getElementById("searchFriendRequest").innerHTML = xmlHttp.responseText;
          else if(mode == 1)
            document.getElementById("searchSentRequest").innerHTML = xmlHttp.responseText;
          else
            document.getElementById("searchDeclinedRequest").innerHTML = xmlHttp.responseText;
        }
        if(mode == 0)
          var url = "searchRequest.php?mode=0";
        else if(mode == 1) 
          var url = "searchRequest.php?mode=1";
        else
          var url = "searchRequest.php?mode=2";
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
      }

      function friendRequest(id, status) {
        //document.getElementById(id).innerHTML = id+" "+status;
        var xmlHttp;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
          document.getElementById(id).innerHTML = xmlHttp.responseText;
        }
        var url = "addfriend.php?id="+id+"&status="+status;
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
      }

      function hideSendRequest(mode) {
        if(mode == 0)
          document.getElementById("searchSentRequest").innerHTML = "";
        else
          document.getElementById("searchDeclinedRequest").innerHTML = "";
      }

      function getGameRoom() {
        var xmlHttp;
        xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function() {
          document.getElementById("gameRooms").innerHTML = xmlHttp.responseText;
        }
        var url = "getRoom.php";
        xmlHttp.open("GET", url, true);
        xmlHttp.send(null);
      }


      $(document).ready(function() {
          var data = [];
          
            //var group = {label: 'Group ' + (i + 1), children: []};
           // for (var j = 0; j < 10; j++) {
         /* data.push({ label: 'haha', value: 'haha'});
          data.push({ label: 'hehe', value: 'hehe'});
          data.push({ label: 'hihi', value: 'hihi'});*/
          <?php
          $conn = mysqli_connect("localhost", "root", "1.8Turbo","drawandguess");
          if ($conn->connect_error)  {
            exit;
          }

          $query = "SELECT user_one_id from relationship where user_two_id = \"".$_SESSION["userId"]."\" and status = '0'";
          $result = $conn->query($query);
          $result->data_seek(0);
          while ($row = $result->fetch_assoc()) { 
              $query1 = "SELECT userName, userEmail, status from users where userId = \"".$row["user_one_id"]."\" group by userName";
              $result1 = $conn->query($query1);
              $result1->data_seek(0);
                while($row1 = $result1->fetch_assoc()) {
                  if($row1["status"] == 'T') 
                    $statusInfo = "online";
                  else
                    $statusInfo = "offline";
                  //echo "data.push({ label: \"".$_SESSION["userName"]."\", value: \"hihi\"});";
                  print("data.push({ label: \"Name: ".$row1["userName"]." Email: ".$row1["userEmail"]." Status: ".$statusInfo."\", value: \"".$row["user_one_id"]."\"});");
            } }

            $query = "SELECT user_two_id from relationship where user_one_id = \"".$_SESSION["userId"]."\" and status = '0'";
            $result = $conn->query($query);
            $result->data_seek(0);
            while ($row = $result->fetch_assoc()) {
              $query1 = "SELECT userName, userEmail, status from users where userId = \"".$row["user_two_id"]."\" group by userName";
              $result1 = $conn->query($query1);
              $result1->data_seek(0);
              while($row1 = $result1->fetch_assoc()) {
                if($row1["status"] == 'T') 
                  $statusInfo = "online";
                else
                  $statusInfo = "offline";
                print("data.push({ label: \"Name: ".$row1["userName"]." Email: ".$row1["userEmail"]." Status: ".$statusInfo."\", value: \"".$row["user_two_id"]."\"});");
              }

            }
          $conn->close();
          ?>
          
 
          //data.push(group);
          
 
      $(document).ready(function() {
        $('#example-large-dataprovider').multiselect({
            buttonWidth: '850px',
            maxHeight: 300,
            enableCaseInsensitiveFiltering: true,
            numberDisplayed: 10,
        });
        $('#example-large-dataprovider').multiselect('dataprovider', data);
      });
    });

    </script>
  </head>

  <body onload="getGameRoom()">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span id="userName" class="navbar-brand"><white>Welcome! <?php echo $_SESSION["userName"];?></white></span>
<!--           <a class="navbar-brand" href="#">Project name</a> -->
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo $email; ?>&nbsp;<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#" data-toggle="modal" data-target="#myModal"><span class="glyphicon glyphicon-edit"></span>&nbsp;Manage Account</a></li>
                <li><a href="logout.php?logout"><span class="glyphicon glyphicon-log-out"></span>&nbsp;Sign Out</a></li>
              </ul>
            </li>
          </ul>
         <!--  <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form> -->
        </div>
      </div>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li ><a href="#" data-toggle="modal" data-target="#message" onclick="checkInbox(0)">Messages</a></li>
            <li><a href="#" data-toggle="modal" data-target="#friend">Add Friends</a></li>
<!--             <li><a href="#">Analytics</a></li>
            <li><a href="#">Export</a></li> -->
          </ul>
          <!-- <ul class="nav nav-sidebar">
            <li><a href="">Nav item</a></li>
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
            <li><a href="">More navigation</a></li>
          </ul> 
          <ul class="nav nav-sidebar">
            <li><a href="">Nav item again</a></li>
            <li><a href="">One more nav</a></li>
            <li><a href="">Another nav item</a></li>
          </ul> -->
        </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
        <h1 class="page-header">Game History</h1>
        <div>
          
        </div>
        
          <h1 class="page-header">Game Rooms<button class="btn btn-info btn-lg" onClick="getGameRoom()" style="float: right;">Refresh</button></h1>          

          <div class="row placeholders" id="gameRooms">
            <!-- <div class="col-xs-6 col-sm-3 placeholder">
              <a href="createRoom.php">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
              </a>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder">
              <img src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
              <h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div> -->

          </div>

          <h1 class="page-header">Create Game Room</h1>
          <div>
            <!-- <table class="table table-striped">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                  <th>Header</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1,001</td>
                  <td>Lorem</td>
                  <td>ipsum</td>
                  <td>dolor</td>
                  <td>sit</td>
                </tr>
              </tbody>
            </table> -->
            <!-- <select id="example-multiple-selected" multiple="multiple">
            <div id="friendList"></div>
                <option value="cheese">Cheese</option>
                <option value="tomatoes">Tomatoes</option>
                <option value="mozarella">Mozzarella</option>
                <option value="mushrooms">Mushrooms</option>
                <option value="pepperoni">Pepperoni</option>
                <option value="onions">Onions</option>
            </select> 
            &nbsp;&nbsp;<button class="btn btn-info" type="button" id="example-large-dataprovider-button" style="width: 15%">Update Friend List</button> -->
            <form method="GET" action="createRoom.php">
            <div class="row">
              <div class="col-lg-9">
                <div class="input-group">
              <select id="example-large-dataprovider" name="selectedFriend[]" multiple="multiple"></select>
              <span class="input-group-btn" >
              <button class="btn btn-info" value="Refresh Page" onClick="window.location.reload()" style="width:100px">Refresh</button>
              </span>
              </div>
              </div>
              </div>
              <br>
            <div class="row">
              <div class="col-lg-9">
                <div class="input-group">
                  <input type="text" name="roomName" class="form-control" pattern="^[a-zA-Z0-9]{1,30}$" placeholder="Please type a name for your room" required style="width:850px" />
                  <span class="input-group-btn" >
                  <button class="btn btn-success" type="submit" style="width:100px">Create</button>
                  </span>
                </div>
              </div>
            </div>

            </form>
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
  <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">
     
     <div class = "modal-dialog">
        <div class = "modal-content">
           
           <div class = "modal-header">
              <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true"> &times; </button>
              <h4 class = "modal-title" id = "myModalLabel">Modify</h4>
           </div>
           
           <div class = "modal-body">
              <form id="signUp" class="form-signUp" method="post" action='<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>' onsubmit="return check()">
                <label>Email</label>
                <input type="email" id="inputEmail2" name="inputEmail2" class="form-control" value="<?php echo $email;?>" readonly="readonly" required autofocus>
                <label>User Name</label>
                <input type="name" id="inputUserName" name="inputUserName" class="form-control" required>
                <label>Password</label>
                <input type="password" id="Password" name="Password" class="form-control" placeholder="Password: 8 characters, 1 uppercase, 1 lowercase and 1 number" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="At least 1 uppercase letter, 1 lowercase letter and 1 number. Length should be at least 8 characters. " required>
                <label>Confirm Password</label>
                <input type="password" id="inputPasswordConfirm" class="form-control" required>
                <span id="info" name="info" class="text-danger" > </span>
           </div>
           
           <div class = "modal-footer">
              <button type = "button" class = "btn btn-default" data-dismiss = "modal"> Close </button>
              <input type = "submit" name="submit" value="submit" class = "btn btn-success" />
           </div>
              </form>
           
        </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

<div class = "modal fade" id = "friend" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">
     
     <div class = "modal-dialog">
        <div class = "modal-content">
           
           <div class = "modal-header">
              <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true"> &times; </button>
              <h4 class = "modal-title" id = "friendLabel">Add Friends</h4>
           </div>
           <div class = "modal-body">
           <h5 class="sub-header">Search by email</h5>
           <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                <input type="text" id="searchEmail" class="form-control" style="width: 400px;" placeholder="Search by email...">
                <span class="input-group-btn" >
                  <button class="btn btn-default" type="button" onclick="searchEmail()">Search!</button>
                </span>
            </div><!-- /input-group -->
           </div><!-- /.col-lg-6 -->
           </div>
           <div class="table-responsive">
            <table class="table table-striped" id="searchEmailInfo">
            </table>
          </div>
           <h5 class="page-header">Search by name</h5>
           <div class="row">
            <div class="col-lg-6">
                <div class="input-group">
                <input type="text" id="searchName" class="form-control" style="width: 400px;" placeholder="Search by name...">
                <span class="input-group-btn" >
                  <button class="btn btn-default" type="button" onclick="searchName()">Search!</button>
                </span>
            </div><!-- /input-group -->
           </div><!-- /.col-lg-6 -->
           </div>
           <div class="table-responsive">
            <table class="table table-striped"  id="searchNameInfo">
            <tbody>
              
            </tbody>
            </table>
          </div>
           </div>
           <div class = "modal-footer">
              <button type = "button" class = "btn btn-primary" data-dismiss = "modal"> Close </button>
           </div>
           </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

<div class = "modal fade" id = "message" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">
     
     <div class = "modal-dialog">
        <div class = "modal-content">
           
          <div class = "modal-header">
            <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true"> &times; </button>
            <h4 class = "modal-title" id = "myModalLabel">Messages</h4>
          </div>

          <div class="modal-body">
          <div>
            <h5 class="sub-header">Friend Requests&nbsp;&nbsp;<button class="btn btn-info btn-sm" type="button" onclick="checkInbox(0)" style="width: 12%">Refresh</button></h5>
          </div>
          
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody id="searchFriendRequest">
              
            </tbody>
            </table>
          </div>
          <h5 class="sub-header">Sent Requests&nbsp;&nbsp;<button class="btn btn-warning btn-sm" type="button" onclick="checkInbox(1)" style="width: 12%">Check</button>&nbsp;&nbsp;<button class="btn btn-default btn-sm" type="button" onclick="hideSendRequest(0)" style="width: 12%">Hide</button></h5>          
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody id="searchSentRequest">
              
            </tbody>
            </table>
          </div>

          <h5 class="sub-header">Declined Requests&nbsp;&nbsp;<button class="btn btn-warning btn-sm" type="button" onclick="checkInbox(2)" style="width: 12%">Check</button>&nbsp;&nbsp;<button class="btn btn-default btn-sm" type="button" onclick="hideSendRequest(1)" style="width: 12%">Hide</button></h5>          
          <div class="table-responsive">
            <table class="table table-striped">
            <tbody id="searchDeclinedRequest">
              
            </tbody>
            </table>
          </div>
          </div><!-- /.modal-body -->
          <div class = "modal-footer">
              <button type = "button" class = "btn btn-primary" data-dismiss = "modal"> Close </button>
           </div>
           </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <!-- <script src="../../dist/js/bootstrap.min.js"></script> -->
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <!-- <script src="../../assets/js/vendor/holder.min.js"></script> -->
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <!-- <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script> -->

  </body>
</html>
