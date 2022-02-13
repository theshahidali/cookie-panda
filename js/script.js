$(document).ready(function(){
    var cookiePanda = getCookie('cookie-panda');

    if( cookiePanda == 'true' ){
        $("#cookie-panda").css('display', 'none');
    }else{
        $("#cookie-panda").css('display', 'block');
    }
    
    $("#cookie-accept").click(function(){
        setCookie('cookie-panda', 'true', 30);
        $("#cookie-panda").css('display', 'none');
    });

    function setCookie(key, value, days) {
        const date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        let expires = "expires="+ date.toUTCString();
        document.cookie = key + "=" + value + ";" + expires + ";path=/";
    }

    function getCookie(key) {
        let name = key + "=";
        let cookie = decodeURIComponent(document.cookie);
        let ca = cookie.split(';');
        for(let i = 0; i <ca.length; i++) {
          let c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }

});