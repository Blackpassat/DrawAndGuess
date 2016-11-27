<?php
  session_start();
  if(isset($_SESSION["userId"]))
    header("Location: ../home/home.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="../bootstrap/css/theme.css" rel="stylesheet">
    <!-- <link href="cover.css" rel="stylesheet"> -->
    <script type="text/javascript">

    function checkEmail() {
      
      var email = document.getElementById('inputEmail2').value;
      var pwd = document.getElementById("Password").value;
      var pwdConfirm = document.getElementById("inputPasswordConfirm").value;
      var xmlHttpQ1;
      xmlHttpQ1 = new XMLHttpRequest();
      //document.getElementById('emialInfo').innerHTML = "email: "+email;
      xmlHttpQ1.onreadystatechange = function() {
        if(xmlHttpQ1.readyState == 4) {
          if(xmlHttpQ1.responseText == "error") {
            document.getElementById('emailInfo').innerHTML = "<p><em>The email has been used</em></p>";
            document.getElementById("Password").value = "";
            document.getElementById("inputPasswordConfirm").value = "";
            info.innerHTML = "";
          } else {
            if(pwd == pwdConfirm) {
              //console.log(document.getElementById("signUp"));
              document.getElementById("signUp").submit();
            } else {
              info.innerHTML = '<em> These two passwords are not match! </em>';
              document.getElementById("Password").value = "";
              document.getElementById("inputPasswordConfirm").value = "";
              document.getElementById('emailInfo').innerHTML = "";
            }
          }
            
            //document.getElementById('emailInfo').innerHTML = xmlHttpQ1.responseText;
        }
      }
      var url = "verify.php?email="+email;
      xmlHttpQ1.open("GET", url, true); 
      xmlHttpQ1.send(null);

    }

    function verify() {
      var email = document.getElementById("inputEmail").value;
      var pwd = document.getElementById("inputPassword").value;
      //document.getElementById("emailNotice").innerHTML = email + " " +pwd;
      var param = "email="+email+"&pwd="+pwd;
      var xmlHttp;
      xmlHttp = new XMLHttpRequest();
      xmlHttp.onreadystatechange = function() {
        if(xmlHttp.readyState == 4) {
          //document.getElementById("emailNotice").innerHTML = xmlHttp.responseText;
          if (xmlHttp.responseText == '1') {
            document.getElementById("emailNotice").innerHTML = "<em>Account does not exist!</em>"
            document.getElementById("pwdNotice").innerHTML = "";
            document.getElementById("inputPassword").value = "";
          } else if(xmlHttp.responseText == '2') {
            document.getElementById("pwdNotice").innerHTML = "<em>Password not correct!</em>"
            document.getElementById("emailNotice").innerHTML = "";
            document.getElementById("inputPassword").value = "";
          } else 
            document.getElementById("signIn").submit();
        }
      }
      var url = "checkLogIn.php";
      xmlHttp.open("POST", url, true); 
      xmlHttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xmlHttp.send(param);
    }

    </script>
  </head>
  <body>
  	<div class="container theme-showcase" role="main">
  		<div class="jumbotron">
          <center>
          <img src="./img/loginIcon.png" width="200" height="200" class="img-responsive" alt="Generic placeholder thumbnail">
          
          <h1><strong>Draw and Guess</strong></h1>
          <p>This is a template showcasing the optional theme stylesheet included in Bootstrap. Use it as a starting point to create something more unique by building on or modifying it.</p>
          </center>
          <hr/>

    		<div class="container">
          <form class="form-signin" id="signIn" method="post" action="../home/home.php">
            <h2 class="form-signin-heading">Please sign in</h2>

            <input type="email" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
            <span id="emailNotice" class="text-danger"></span>
            <input type="password" id="inputPassword" class="form-control" placeholder="Password: 8 characters, 1 uppercase, 1 lowercase and 1 number" pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$" title="At least 1 uppercase letter, 1 lowercase letter and 1 number. Length should be at least 8 characters. " required>
            <span id="pwdNotice" class="text-danger"></span>

            <div class="checkbox">
              <label>
                <input type="checkbox" value="remember-me"> Remember me
              </label>
            </div>

            <button class="btn btn-lg btn-primary btn-block" type="button" value="submit" onclick="verify()">Sign in</button>
            <center><label style="text-align: center; padding-top: 10px">Don't have a account? <a href="#" data-toggle = "modal" data-target = "#myModal">Register here</a></label></center>
          </form>
        </div> <!-- /container -->
      </div>
    </div>

        <!-- Modal -->
  <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true">
     
     <div class = "modal-dialog">
        <div class = "modal-content">
           
           <div class = "modal-header">
              <button type = "button" class = "close" data-dismiss = "modal" aria-hidden = "true"> &times; </button>
              <h4 class = "modal-title" id = "myModalLabel">Register</h4>
           </div>
           
           <div class = "modal-body">
              <form id="signUp" class="form-signUp" method="post" action="../home/home.php" >
                <label>Email</label>
                <input type="email" id="inputEmail2" name="inputEmail" class="form-control" required autofocus>
                <span id="emailInfo" name="emailInfo" class="text-danger"> </span>
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
              <input type = "button" name="btnsubmit" value="submit" class = "btn btn-success" onclick="checkEmail()" />
           </div>
              </form>
           
        </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
  
</div><!-- /.modal -->

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>