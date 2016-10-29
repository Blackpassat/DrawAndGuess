class Point {
  constructor(x, y) {
    this.x = x;
    this.y = y;
  }
}

class StrokeUnit {
	constructor (color, lineWidth, startPoint) {
		this.color = color;
		this.lineWidth = lineWidth;
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

	startDrawing(color, lineWidth, startPoint) {
		this.currentStroke = new StrokeUnit(color, lineWidth, startPoint);
		this.ctx.lineWidth = lineWidth;
		this.ctx.strokeStyle = color;
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

	// redoDrawing() {
	// 	var lastStrokeUnit = this.strokeArray.pop();
	// 	if (!lastStrokeUnit) return;
	// 	this.startDrawing("#FFFFFF", lastStrokeUnit.lineWidth, lastStrokeUnit.startPoint);
	// 	for (let point of lastStrokeUnit.pointArray) {
 //  			this.ctx.lineTo(point.x, point.y);
 //    		this.ctx.stroke();
	// 	}
	// }
	redoDrawing() {
		this.ctx.clearRect(0, 0, this.canvas.width, this.canvas.height);
		this.strokeArray.pop();
		for (let stroke of this.strokeArray) {
			this.startDrawing(stroke.color, stroke.lineWidth, stroke.startPoint);
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