function openmenu() {
    if (document.getElementsByClassName('site-menu')[0].classList.contains('open')) {
        document.getElementsByClassName('site-menu')[0].classList.remove('open');
    } else {
        document.getElementsByClassName('site-menu')[0].classList.add('open');
        if (document.getElementsByClassName('links')[0].classList.contains('open')) {
            document.getElementsByClassName('links')[0].classList.remove('open');
        }
    }
}

function openaccountmenu() {
    if (document.getElementsByClassName('links')[0].classList.contains('open')) {
        document.getElementsByClassName('links')[0].classList.remove('open');
    } else {
        document.getElementsByClassName('links')[0].classList.add('open');
        if (document.getElementsByClassName('site-menu')[0].classList.contains('open')) {
            document.getElementsByClassName('site-menu')[0].classList.remove('open');
        }
    }
}

var ee = "";
document.onkeypress = function(event){
    ee = ee + event.key;
}

function newYearCountdownTimer() {
    var today = new Date();
    var newYear = new Date('1 January 2024');
    var days = today - newYear;
    var count_time = new Date(-days + (today.getTimezoneOffset() * 60 * 1000));
    var countdown = Math.floor(-(days / 1000 / 60 / 60 / 60));
    if(countdown >= 0) {
    	var countdown_h = addIntZeros(Math.floor(-(days / 1000 / 60 / 60)) % 24, 2);
    	var countdown_min = addIntZeros(Math.floor(-(days / 1000 / 60)) % 60, 2);
    	var countdown_sec = addIntZeros(Math.floor(-(days / 1000)) % 60, 2);
    	var timezone = '';
    	if((today.getTimezoneOffset() / 60) < 0) {
        	timezone = '+' + (-today.getTimezoneOffset() / 60)
        } else {
        	timezone = '-' + (today.getTimezoneOffset() / 60)
    	};
    	document.getElementById('hours_count').innerHTML = countdown_h;
    	document.getElementById('minutes_count').innerHTML = countdown_min;
    	document.getElementById('seconds_count').innerHTML = countdown_sec;
   } else {
        document.getElementById('hours_count').innerHTML = "00";
    	document.getElementById('minutes_count').innerHTML = "00";
    	document.getElementById('seconds_count').innerHTML = "00";
   }
}

function homepage_onload() {
    setInterval(newYearCountdownTimer, 100);
}

function addIntZeros(num, size) {
    num = num.toString();
    while (num.length < size) num = "0" + num;
    return num;
}
