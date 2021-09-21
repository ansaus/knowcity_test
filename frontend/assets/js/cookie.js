function setApiKey(value, secs) {
    return setCookie('api_key', value, secs);
}

function getApiKey() {
    return getCookie('api_key');
}

function setCookie(name,value,secs) {
    var expires = "";
    if (secs) {
        var date = new Date();
        date.setTime(date.getTime() + (secs*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
