class Point {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
}

class StrokeStyle {
	constructor(color, lineWidth) {
		this.color = color;
		this.lineWidth = lineWidth;
	}
}

class StrokeUnit {
	constructor (style, startPoint) {
		this.style = style;
		this.startPoint = startPoint;
		this.pointArray = [startPoint];

		this.appendNewPoint = function (newPoint) {
			this.pointArray.push(newPoint);
		}
	}
}

class StrokeManager {
	constructor (canvas) {
		this.canvas = canvas;
		this.ctx = canvas.getContext("2d");

		this.currentStroke = null;
		this.strokeArray = [];
	}

	startDrawing(style, startPoint) {
		this.currentStroke = new StrokeUnit(style, startPoint);
		this.ctx.lineWidth = style.lineWidth;
		this.ctx.strokeStyle = style.color;
		this.ctx.beginPath();
		this.ctx.moveTo(startPoint.x, startPoint.y);
	}

	drawPoint(newPoint) {
		this.currentStroke.appendNewPoint(newPoint);
		this.ctx.lineTo(newPoint.x, newPoint.y);
    	this.ctx.stroke();
	}

	endDrawing() {
		if (!this.currentStroke || !this.currentStroke.pointArray || this.currentStroke.pointArray.length == 1) {
			this.currentStroke = null;
		} else {
			this.strokeArray.push(this.currentStroke);
		}
	}

	redoDrawing() {
		this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
		this.strokeArray.pop();
		for (let stroke of this.strokeArray) {
			this.startDrawing(stroke.style, stroke.startPoint);
			for (let point of stroke.pointArray) {
  				this.ctx.lineTo(point.x, point.y);
    			this.ctx.stroke();
			}
		}
	}

	clearDrawing() {
		this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
		this.currentStroke = null;
		this.strokeArray = [];
	}
}