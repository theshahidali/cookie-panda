jQuery.noConflict();
jQuery(document).ready(function(){
    var cookiePanda = getCookie('cookie-panda');

    if( cookiePanda == 'true' ){
        jQuery("#cookie-panda").css('display', 'none');
    }else{
        jQuery("#cookie-panda").css('display', 'flex');
    }
    
    jQuery("#cookie-accept").on('click', function(){
        setCookie('cookie-panda', 'true', 30);
        jQuery("#cookie-panda").css('display', 'none');
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