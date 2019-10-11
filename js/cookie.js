//3 functions from https://stackoverflow.com/a/18652401
function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, '-1');
}

window.onload = function() {
    if(getCookie('cookiesAccepted')) {
        document.getElementById('cookies-banner').style.display = 'none';
    } else {
        document.getElementById('cookies-banner').style.display = 'block';
    }
};


document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('cookies-accept').addEventListener('click',function () {
        if(!getCookie('cookiesAccepted')) {
            setCookie('cookiesAccepted', true, 1);
            document.getElementById('cookies-banner').style.opacity = '0';
            setTimeout(function() {
                document.getElementById('cookies-banner').style.display = 'none';
            }, 1000);

        }
    });
    document.getElementById('cookies-reject').addEventListener('click',function () {
        document.getElementById('darken-background').style.visibility = 'visible';
        document.getElementById('cookies-reject-message').style.opacity = '1';

    });
    document.getElementById('cookies-reject-message-button').addEventListener('click',function () {
        document.getElementById('darken-background').style.visibility = 'hidden';
        document.getElementById('cookies-reject-message').style.opacity = '0';

    });

}, false);

