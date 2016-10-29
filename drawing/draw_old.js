var canvas = document.getElementById('myCanvas');
var ctx = canvas.getContext("2d");
// canvas.addEventListener("mousedown", doMouseDown(evt));

var locationLabel = document.getElementById('cursorLocation');
var redoButton = document.getElementById('redo');

var isTouching = false;
var isDrawing = false;

class Point {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
}

var startPoint = new Point(0, 0);
context_changeColor("#0000FF");
context_changeLineWidth(10);

canvas.onmousedown = function doMouseDown (evt) {
	if (!isTouching) {
		var currentPoint = getMouseLocationOnCanvas(evt);
		startPoint = new Point(currentPoint.x, currentPoint.y);
		isTouching = true;
	}
}

canvas.onmousemove = function doMouseMove (evt) {
	var currentPoint = getMouseLocationOnCanvas(evt);
	locationLabel.innerText = currentPoint.x + ", " + currentPoint.y;
	
	if (isTouching) {
		if (!isDrawing) {
        	context_moveTo(startPoint);
        	isDrawing = true;
		}
        context_drawLine(currentPoint);
    }
}

function doMouseUp() {
	isTouching = false;
	isDrawing = false;
}
canvas.onmouseup = canvas.onmouseout = doMouseUp;

function getMouseLocationOnCanvas(evt) {
	var rect = canvas.getBoundingClientRect();
	return new Point(evt.clientX - rect.left, evt.clientY - rect.top);
}

function context_drawLine(toPoint) {
	ctx.lineTo(toPoint.x, toPoint.y);
    ctx.stroke();
}

function context_moveTo(toPoint) {
	ctx.beginPath();
	ctx.moveTo(toPoint.x ,toPoint.y);
}

function context_changeColor(hexColor) {
	ctx.strokeStyle = hexColor;
}

function context_changeLineWidth(width) {
	ctx.lineWidth = width;
}

function context_finishDrawing() {
	
}

redoButton.onclick = function redo () {

}
