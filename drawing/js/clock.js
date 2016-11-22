var timeWarning = 40;

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

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
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
          var twinkleinterval = setInterval(twinkle, 1000);
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
    }
  }

  function twinkle() {
    if (shouldTwinkle) {
      minutesSpan.style.display = 'none';
      secondsSpan.style.display = 'none';
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 500);
}
console.log("Hello, I am here");
var deadline = new Date(Date.parse(new Date()) + 1 * 60 * 1000);
initializeClock('clockdiv', deadline);