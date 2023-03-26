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
    if (ee == "gpg") {
        window.location.replace("/vc_pub.gpg");
    }
}
