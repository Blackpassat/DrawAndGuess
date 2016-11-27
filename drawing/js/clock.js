var timeWarning = 10;
var twinkleinterval
var timeinterval;
var callbackTimeInterval;

class Clock {
  constructor(deadline, callback) {
    this.resetTimer();
    clearInterval(callbackTimeInterval);
    this.deadline = deadline;
    initializeClock('clockdiv', deadline, callback);
  }

  isTimeout() {
    var t = getTimeRemaining(this.deadline);
    console.log(t);
    return (t.total <= 1000);
  }

  resetTimer() {
    clearInterval(timeinterval);
    clearInterval(twinkleinterval);
    clearInterval(callbackTimeInterval);
    document.getElementById('clockdiv').style.display = 'none';
  }
}

function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime, callback) {
  var clock = document.getElementById(id);
  clock.style.display = 'block';
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');
  var shouldTwinkle = false;

  function updateClock() {
    var t = getTimeRemaining(endtime);
    var minuteDisplay = ('0' + t.minutes).slice(-2) + " :";
    var secondDisplay = ('0' + t.seconds).slice(-2);
    if (t.minutes == 0 && t.seconds < timeWarning) {
        minuteDisplay = "<danger>" + minuteDisplay + "</danger>";
        secondDisplay = "<danger>" + secondDisplay + "</danger>";
        if (!shouldTwinkle) {
          twinkleinterval = setInterval(twinkle, 1000);
          shouldTwinkle = true;
        }
    }
    minutesSpan.style.display = 'block';
    secondsSpan.style.display = 'block';
    minutesSpan.innerHTML = minuteDisplay;
    secondsSpan.innerHTML = secondDisplay;

    if (t.total <= 0) {
      clearInterval(timeinterval);
      clearInterval(twinkleinterval);
      clearInterval(callbackTimeInterval);
    }
  }

  function twinkle() {
    if (shouldTwinkle) {
      minutesSpan.style.display = 'none';
      secondsSpan.style.display = 'none';
    }
  }

  updateClock();
  timeinterval = setInterval(updateClock, 500);
  callbackTimeInterval = setInterval(callback, 500);
}
