// require('StrokeUnit.js')();

var canvas = document.getElementById('myCanvas');
var strokeManager = new StrokeManager(canvas);

// canvas.addEventListener("mousedown", doMouseDown(evt));

var locationLabel = document.getElementById('cursorLocation');
var redoButton = document.getElementById('redo');
var clearButton = document.getElementById('clear');

var isDrawing = false;

var startPoint = new Point(0, 0);
var color = "#0000FF";
var lineWidth = 10;

canvas.onmousedown = function doMouseDown (evt) {
	if (!isDrawing) {
		var currentPoint = getMouseLocationOnCanvas(evt);
		startPoint = new Point(currentPoint.x, currentPoint.y);
		strokeManager.startDrawing(color, lineWidth, startPoint);
		isDrawing = true;
	}
}

canvas.onmousemove = function doMouseMove (evt) {
	var currentPoint = getMouseLocationOnCanvas(evt);
	locationLabel.innerText = currentPoint.x + ", " + currentPoint.y;
	if (isDrawing) {
		strokeManager.drawPoint(currentPoint);
    }
}

function doMouseUp() {
	strokeManager.endDrawing();
	isDrawing = false;
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
