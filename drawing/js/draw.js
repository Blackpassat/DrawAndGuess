// require('StrokeUnit.js')();

var canvas = document.getElementById('myCanvas');
var strokeManager = new StrokeManager(canvas);

// canvas.addEventListener("mousedown", doMouseDown(evt));

var locationLabel = document.getElementById('cursorLocation');
var undoButton = document.getElementById('undo');
var clearButton = document.getElementById('clear');
var saveButton = document.getElementById('save');

var isDrawing = false;

var startPoint = new Point(0, 0);
var strokeStyle = new StrokeStyle("#0000FF", 10);

var networkManager = new NetworkManager();
networkManager.registerServer_drawing("http://localhost:1234", startDrawing, drawPoint, endDrawing, undoDrawing, clearDrawing);

function receiveData(data) {
	locationLabel.innerText = data;
}

function startDrawing(strokeStyle, startPoint) {
	strokeManager.startDrawing(strokeStyle, startPoint);
}

function drawPoint(currentPoint) {
	strokeManager.drawPoint(currentPoint);
}

function endDrawing() {
	strokeManager.endDrawing();
}

canvas.onmousedown = function doMouseDown (evt) {
	if (!isDrawing) {
		var currentPoint = getMouseLocationOnCanvas(evt);
		startPoint = new Point(currentPoint.x, currentPoint.y);
		strokeManager.startDrawing(strokeStyle, startPoint);
		networkManager.sendData_start(strokeStyle, startPoint);
		isDrawing = true;
	}
}

canvas.onmousemove = function doMouseMove (evt) {
	var currentPoint = getMouseLocationOnCanvas(evt);
	locationLabel.innerText = currentPoint.x + ", " + currentPoint.y;
	if (isDrawing) {
		strokeManager.drawPoint(currentPoint);
		networkManager.sendData_startDrawing(currentPoint);
    }
}

function doMouseUp() {
	if (isDrawing) {
		strokeManager.endDrawing();
		networkManager.sendData_endDrawing();
		isDrawing = false;
	}
}
canvas.onmouseup = canvas.onmouseout = doMouseUp;

function getMouseLocationOnCanvas(evt) {
	var rect = canvas.getBoundingClientRect();
	return new Point(evt.clientX - rect.left, evt.clientY - rect.top);
}

function undoButtonClicked () {
	undoDrawing();
	networkManager.sendData_undoDrawing();
}

function undoDrawing() {
	strokeManager.undoDrawing();
}

undoButton.onclick = undoButtonClicked;

function clearButtonClicked () {
	clearDrawing();
	networkManager.sendData_clearDrawing();
}

function clearDrawing() {
	strokeManager.clearDrawing();
}

clearButton.onclick = clearButtonClicked;

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

function changeStrokeColor (color) {
	strokeStyle = new StrokeStyle(color, strokeStyle.lineWidth);
}

function changeStrokeLineWidth (lineWidth) {
	strokeStyle = new StrokeStyle(strokeStyle.color, lineWidth);
	document.getElementById('lineWidth_label').innerText = "Line Width: " + lineWidth;
}
