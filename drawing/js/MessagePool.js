class MessagePool {
	constructor() {
		this.messageQueue = [];
		this.messageMarquee = document.getElementById("chatMessageMarquee");
		this.messageLabel = document.getElementById("chatMessageLabel");
		setTimeout(this.showMessage.bind(this), 4000);
	}

	pushMessage(message) {
		this.messageQueue.unshift(message);
	}

	showMessage() {
		var message = this.messageQueue.pop(); 
		if (message != null) {
			this.messageLabel.innerText = message;
		} 
		setTimeout(this.showMessage.bind(this), 4000);
	}
}

