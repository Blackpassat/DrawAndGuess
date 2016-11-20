// require('StrokeUnit.js')();

var canvas = document.getElementById('myCanvas');
var strokeManager = new StrokeManager(canvas);

// canvas.addEventListener("mousedown", doMouseDown(evt));

var locationLabel = document.getElementById('cursorLocation');
var redoButton = document.getElementById('redo');
var clearButton = document.getElementById('clear');

var isDrawing = false;

var startPoint = new Point(0, 0);
var strokeStyle = new StrokeStyle("#0000FF", 10);

var networkManager = new NetworkManager();
networkManager.registerServer_drawing("http://localhost:1234", this.startDrawing, drawPoint, endDrawing);

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

redoButton.onclick = function redo () {
	strokeManager.redoDrawing();
}

clearButton.onclick = function clear() {
	strokeManager.clearDrawing();
}

function changeStrokeColor (color) {
	strokeStyle = new StrokeStyle(color, strokeStyle.lineWidth);
}

function changeStrokeLineWidth (lineWidth) {
	strokeStyle = new StrokeStyle(strokeStyle.color, lineWidth);
}
