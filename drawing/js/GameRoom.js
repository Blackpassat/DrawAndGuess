var canvas = document.getElementById('myCanvas');
var locationLabel = document.getElementById('cursorLocation');
var undoButton = document.getElementById('undo');
var clearButton = document.getElementById('clear');
var saveButton = document.getElementById('save');
var sendChatMessageButton = document.getElementById('sendChatMessageButton');
var strokeWidthChanger = document.getElementById('strokeWidthChanger');

var networkManager = null;
var strokeManager = new StrokeManager(canvas);
var isDrawing = false;
var startPoint = new Point(0, 0);
var strokeStyle = new StrokeStyle("#0000FF", 10);
var messagePool = new MessagePool();

class GameRoom {
	constructor(manager) {
		networkManager = manager;
	}

	prepareForGame() {
		var self = this;

		networkManager.registerChannel_drawing(self.startDrawing, self.drawPoint, self.endDrawing, self.undoDrawing, self.clearDrawing);
		networkManager.registerChannel_chat(self.receiveChatMessage, self.receiveChatMessage);

		canvas.onmousedown = function doMouseDown (evt) {
			if (!isDrawing) {
				var currentPoint = self.getMouseLocationOnCanvas(evt);
				startPoint = new Point(currentPoint.x, currentPoint.y);
				strokeManager.startDrawing(strokeStyle, startPoint);
				networkManager.sendData_start(strokeStyle, startPoint);
				isDrawing = true;
			}
		}

		canvas.onmousemove = function doMouseMove (evt) {
			var currentPoint = self.getMouseLocationOnCanvas(evt);
			locationLabel.innerText = currentPoint.x + ", " + currentPoint.y;
			if (isDrawing) {
				strokeManager.drawPoint(currentPoint);
				networkManager.sendData_startDrawing(currentPoint);
		    }
		}

		canvas.onmouseup = function doMouseUp() {
			if (isDrawing) {
				strokeManager.endDrawing();
				networkManager.sendData_endDrawing();
				isDrawing = false;
			}
		};

		canvas.onmouseout = function doMouseUp() {
			if (isDrawing) {
				strokeManager.endDrawing();
				networkManager.sendData_endDrawing();
				isDrawing = false;
			}
		};

		undoButton.onclick = function undoButtonClicked () {
			self.undoDrawing();
			networkManager.sendData_undoDrawing();
		}

		clearButton.onclick = function clearButtonClicked () {
			self.clearDrawing();
			networkManager.sendData_clearDrawing();
		}

		saveButton.onclick = function save() {
			var imageName = '';
			var ctx = canvas.getContext("2d");
		    if (ctx) {
		        var xmlhttp = new XMLHttpRequest;
		        xmlhttp.onreadystatechange = function () {
		            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
		                var src = xmlhttp.responseText;
		                window.open(src);
		            }
		        };
		        var image = canvas.toDataURL();
		        xmlhttp.open("post", "saveDrawing.php", true);
		        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		        xmlhttp.send("img=" + image);
		    }
		}

		strokeWidthChanger.onmousemove = function changeStrokeLineWidth () {
			var lineWidth = strokeWidthChanger.value;
			strokeStyle = new StrokeStyle(strokeStyle.color, lineWidth);
			document.getElementById('lineWidth_label').innerText = "Line Width: " + lineWidth;
		}

		sendChatMessageButton.onclick = function sendChatMessage() {
			var chatInput = document.getElementById('chatInput');
			if (chatInput.value != "") {
				messagePool.pushMessage(chatInput.value);
				networkManager.sendData_chatMessage(chatInput.value);
				chatInput.value = "";
			}
		}
	}

	receiveData(data) {
		locationLabel.innerText = data;
	}

	startDrawing(strokeStyle, startPoint) {
		strokeManager.startDrawing(strokeStyle, startPoint);
	}

	drawPoint(currentPoint) {
		strokeManager.drawPoint(currentPoint);
	}

	endDrawing() {
		strokeManager.endDrawing();
	}

	getMouseLocationOnCanvas(evt) {
		var rect = canvas.getBoundingClientRect();
		return new Point(evt.clientX - rect.left, evt.clientY - rect.top);
	}

	undoDrawing() {
		strokeManager.undoDrawing();
	}

	clearDrawing() {
		strokeManager.clearDrawing();
	}

	receiveChatMessage(message) {
		console.log("Received");
		console.log(message);
		messagePool.pushMessage(message);
	}

	changeStrokeColor (color) {
		strokeStyle = new StrokeStyle(color, strokeStyle.lineWidth);
	}
}