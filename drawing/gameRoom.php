<?php
     $ROOM_ID = $_GET["roomId"];
     $MY_USER_ID = $_GET["userId"];
     $MY_USER_NAME = $_GET["userName"];
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

    <!-- Font awesome -->
    <link rel="stylesheet" href="../font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="./css/customButton.css">
    <link rel="stylesheet" type="text/css" href="./css/clock.css">
  </head>
  <body onload="load()">
  	<div class="container theme-showcase" role="main">
  		<div class="jumbotron" style="background-color: white; background-image: url('img/background.png')">
        <center>
        <div style="color: white; background-color: #D5CED2; width: 600px; height: 50px; border-radius: 10px; margin-bottom: 5px; background-image: url('img/question_bar.jpg')">
          <div class="row" style="padding-right: 0px;"> 
              <div class="col-sm-1 col-md-1" style="margin-left: 15px;">
                <i class="fa fa-gamepad fa-3x" aria-hidden="true" style="padding-top: 4px;"></i>
              </div>
 
              <div class="col-sm-2 col-md-2" style="margin-top: 13px; text-align: left; margin-right: 10px">
                <label id="questionArea" style="font-size: 20px; display: none">QUESTION: </label>
              </div>

              <div class="col-sm-6 col-md-6" style="margin-top: 13px; text-align: left;">
                <label id="questionLabel" style="font-size: 20px; display: none">IRON MAN</label>
              </div>


              <div id="clockdiv" class="col-sm-2 col-md-2" style="margin-top: 10px; padding-right: 0px">
                  <div><span class="minutes"></span></div>
                  <div><span class="seconds"></span></div>
              </div>
          </div>
        </div>

				<canvas id="myCanvas" width="600" height="600" style="border:1px solid green; cursor:crosshair; background-color: white; border-radius: 8px">    
        </canvas>

        <div class="jumbotron" style="background-color: white; padding-top: 10px; margin-bottom: 5px; width: 600px; height: 50px">
          <ul class="list-inline">
            <li><i class="fa fa-quote-left fa-2x" aria-hidden="true"></i></li>
            
            <li style="width: 400px">
                <h4><marquee behavior="scroll" direction="left" scrollamount="5" id="chatMessageMarquee">
                <i class="fa fa-volume-up" aria-hidden="true" style="margin-right: 5px;"></i>
                  <span id="chatMessageLabel">Wow, nice drawing...</span>
                </marquee></h4>
            </li>

            <li><i class="fa fa-quote-right fa-2x" aria-hidden="true"></i></li>
          </ul>
        </div>

        <div class="jumbotron" style="background-color: white; padding-top: 10px; padding-bottom: 10px; width: 600px; padding-left: 10px; padding-right: 10px">

          <ul class="nav nav-pills">
              <li class="active"><a href="#tab1" data-toggle="tab"><i class="fa fa-cog" aria-hidden="true"></i> ROOM</a></li>
              <li><a href="#tab2" data-toggle="tab"><i class="fa fa-th" aria-hidden="true"></i> COLOR</a></li>
              <li><a href="#tab3" data-toggle="tab"><i class="fa fa-paint-brush" aria-hidden="true"></i> STROKE</a></li>
              <li><a href="#tab4" data-toggle="tab"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> EDIT</a></li>
              <li><a href="#tab5" data-toggle="tab"><i class="fa fa-crosshairs" aria-hidden="true"></i> GUESS</a></li>
              <li><a href="#tab6" data-toggle="tab"><i class="fa fa-comments" aria-hidden="true"></i> CHAT</a></li>
          </ul>

          <div class="tab-content">

              <div class="tab-pane active" id="tab1">
                <div class="panel panel-default">
                <div class="panel-heading">CURRENT PLAYERS</div>
                    <ul class="list-group" id="currentUsersList">
                      <li class="list-group-item list-group-item-success"><i class="fa fa-user-circle-o" aria-hidden="true" style="padding-right: 10px"></i>Spark_Shen</li>
                      <li class="list-group-item list-group-item-default"><i class="fa fa-user-circle-o" aria-hidden="true" style="padding-right: 10px"></i>Raymond_Xue</li>
                      <li class="list-group-item list-group-item-default"><i class="fa fa-user-circle-o" aria-hidden="true" style="padding-right: 10px"></i>Yisha_Yi</li>
                    </ul>
                <div class="panel-heading">SETTINGS</div>
                    <ul class="list-group">
                        <li class="list-group-item list-group-item-default"><button id="startGame" class="btn btn-small btn-success"><i class="fa fa-bomb" aria-hidden="true"></i> START GAME</button>

                        <button id="leaveGame" class="btn btn-small btn-danger"><i class="fa fa-sign-out" aria-hidden="true"></i> LEAVE GAME</button>
                      </li>
                    </ul>
                </div>
              </div>

              <div class="tab-pane" id="tab2">
                <button type="button" class="btn btn-default btn-circle" style="background-color: #000000" onclick="changeStrokeColor('#000000')"></button>
                <button type="button" class="btn btn-default btn-circle" style="background-color: #0000FF" onclick="changeStrokeColor('#0000FF')"></button>
                <button type="button" class="btn btn-default btn-circle" style="background-color: #00FF00" onclick="changeStrokeColor('#00FF00')"></button>
                <button type="button" class="btn btn-default btn-circle" style="background-color: #FF0000" onclick="changeStrokeColor('#FF0000')"></button>  
                <button type="button" class="btn btn-default btn-circle" style="background-color: #FFFF00" onclick="changeStrokeColor('#FFFF00')"></button>
                <button type="button" class="btn btn-default btn-circle" style="background-color: #FF7F00" onclick="changeStrokeColor('#FF7F00')"></button>
                <button type="button" class="btn btn-default btn-circle" style="background-color: #7F007F" onclick="changeStrokeColor('#7F007F')"></button>
                <button type="button" class="btn btn-default btn-circle" style="background-color: #996633" onclick="changeStrokeColor('#996633')"></button>
                <button id="eraser" class="btn btn-small btn-default" onclick="changeStrokeColor('#FFFFFF')"><i class="fa fa-eraser" aria-hidden="true"></i> ERASER</button>
              </div>

              <div class="tab-pane" id="tab3">
                <p>
                  <input type="range" min="5" max="20" step="1" value="10" id="strokeWidthChanger">
                  <span class="label label-primary" id="lineWidth_label">Line Width: 10</span>
                </p>
              </div>

              <div class="tab-pane" id="tab4">
                <p>
                <button id="undo" class="btn btn-small btn-primary"><i class="fa fa-undo" aria-hidden="true"></i> UNDO</button>
                <button id="clear" class="btn btn-small btn-danger"><i class="fa fa-times" aria-hidden="true"></i> CLEAR</button>
                <button id="save" class="btn btn-small btn-success"><i class="fa fa-save" aria-hidden="true"></i> SAVE</button>
                </p>
              </div>

              <div class="tab-pane" id="tab5">
                  <p>
                      <div class="input-group">
                          <input type="text" class="form-control" placeholder="Iron Man" id="guessInput">
                          <span class="input-group-btn">
                            <button id="sendGuessButton" class="btn btn-default" type="button">Go!</button>
                          </span>
                      </div><!-- /input-group -->
                  </p>
              </div>

              <div class="tab-pane" id="tab6">
                <p>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Spark's drawing is so good..." id="chatInput">
                        <span class="input-group-btn">
                          <button class="btn btn-default" type="button" id="sendChatMessageButton">Send!</button>
                          <button class="btn btn-primary" type="button"><i class="fa fa-thumbs-o-up fa-1x" aria-hidden="true"></i></button>
                          <button class="btn btn-warning" type="button"><i class="fa fa-thumbs-o-down fa-1x" aria-hidden="true"></i></button>
                        </span>
                    </div><!-- /input-group -->
                </p>
              </div>

          </div>
        </div>

        <p>Current Location:
        <label id="cursorLocation"></label>
        </p>

	      <button id="gameEnd" type="button" data-toggle="modal" data-target="#myModal" style="display: none;"></button>
        </center>
      </div>
    </div>
    <!-- overlay div for loading state -->
    <div id= "loadingPage" class="overlay" style="display: none;">
      <!-- <center><div class="loader"></div></center> -->
      <center><label class="loaderMessage" id="loadingMessage">Loading...</label></center>
      <center><img class="loaderImg" src="./img/Preloader_2.gif"></center>
    </div>

    <center>
      <div class = "modal fade" id = "myModal" tabindex = "-1" role = "dialog" 
     aria-labelledby = "myModalLabel" aria-hidden = "true" style="top: 20%">
     
     <div class = "modal-dialog" style="width: 200;">
        <div class = "modal-content" style="padding-bottom: 20px; padding-left: 30px; padding-right: 30px; background-image: url('img/background.png')">
            <div class="panel-heading">GAME RESULT</div>
                <ul class="list-group" id="gameResultList">
                </ul>
                <button type = "button" class = "btn btn-default" data-dismiss = "modal">Close</button>
        </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->

    </center>
    
    <script src="js/socket.io.js"></script>
    <script src="js/NetworkManager.js"></script>
    <script src="js/StrokeManager.js"></script>
    <script src="js/MessagePool.js"></script>
    <script src="js/GameRoom.js"></script>
    <script src="js/clock.js"></script>
    <script src="../game/GameRoomManager.js"></script>
    <script type="text/javascript">
      var gameRoomManager;

      var roomID = "<?php echo $ROOM_ID ?>";
      var myUserID = "<?php echo $MY_USER_ID ?>";
      var myUserName = "<?php echo $MY_USER_NAME ?>";

      function load() {
        gameRoomManager = new GameRoomManager("http://localhost:1234", roomID, myUserID, myUserName);
        console.log("onload");
      }

      function changeStrokeColor(colorCode) {
        gameRoomManager.changeStrokeColor(colorCode);
      }
      
    </script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="../bootstrap/js/bootstrap.min.js"></script>
  </body>
</html>