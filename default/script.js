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
    var countdown = Math.floor(-(days / 1000 / 60 / 60 / 24));
    if(countdown < 0) {
        document.getElementById('days_count').innerHTML = '0';
        return;
    }
    var timezone = '';
    if((today.getTimezoneOffset() / 60) < 0) {
        timezone = '+' + (-today.getTimezoneOffset() / 60)
    } else {
        timezone = '-' + (today.getTimezoneOffset() / 60)
    };
    document.getElementById('days_count').innerHTML = countdown;
}

function homepage_onload() {
    setInterval(newYearCountdownTimer, 100);
}

