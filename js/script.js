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

    function updateColorPickers(){
        jQuery('#widgets-right .wp-color-picker').each(function(){
            jQuery(this).wpColorPicker({
                defaultColor: false,
                change: function(event, ui){
                  jQuery("#widget-cookie_panda_widget-2-savewidget").attr("disabled", false)
                },
                clear: function() {
                  jQuery("#widget-cookie_panda_widget-2-savewidget").attr("disabled", false)
                },
                hide: true,
            });
        }); 
    }
    updateColorPickers();   
    jQuery(document).ajaxSuccess(function(e, xhr, settings) {
        if(settings.data.search('action=save-widget') != -1 ) { 
            jQuery('.color-field .wp-picker-container').remove();    
            updateColorPickers();       
        }
    });

    // Privacy button styles

    let privacy_bg_color = jQuery("#cookie-panda #privacy_link").attr('data-bg');
    let privacy_font_color = jQuery("#cookie-panda #privacy_link").attr('data-font');
    
    if(privacy_bg_color !== ""){
      jQuery("#cookie-panda #privacy_link").css({"background-color": privacy_bg_color, "border-color": privacy_bg_color});
    }

    if(privacy_font_color !== ""){
      jQuery("#cookie-panda #privacy_link").css({"color": privacy_font_color});
    }

    jQuery("#cookie-panda #privacy_link").on('mouseover', function(){
      jQuery("#cookie-panda #privacy_link").css({"background-color": "transparent", "border-color": privacy_bg_color});

      if(privacy_bg_color !== ""){
        jQuery("#cookie-panda #privacy_link").css({"color": privacy_bg_color});
      }else{
        jQuery("#cookie-panda #privacy_link").css({"color": "#fff"});
      }
    });

    jQuery("#cookie-panda #privacy_link").on('mouseout', function(){
      jQuery("#cookie-panda #privacy_link").css({"background-color": privacy_bg_color, "border-color": privacy_bg_color});

      if(privacy_font_color !== ""){
        jQuery("#cookie-panda #privacy_link").css({"color": privacy_font_color});
      }else{
        jQuery("#cookie-panda #privacy_link").css({"color": "#000"});
      }
    });

    // Accept button styles

    let accept_bg_color = jQuery("#cookie-panda #cookie-accept").attr('data-bg');
    let accept_font_color = jQuery("#cookie-panda #cookie-accept").attr('data-font');
    
    if(accept_bg_color !== ""){
      jQuery("#cookie-panda #cookie-accept").css({"background-color": accept_bg_color, "border-color": accept_bg_color});
    }

    if(accept_font_color !== ""){
      jQuery("#cookie-panda #cookie-accept").css({"color": accept_font_color});
    }

    jQuery("#cookie-panda #cookie-accept").on('mouseover', function(){
      jQuery("#cookie-panda #cookie-accept").css({"background-color": "transparent", "border-color": accept_bg_color});

      if(accept_bg_color !== ""){
        jQuery("#cookie-panda #cookie-accept").css({"color": accept_bg_color});
      }else{
        jQuery("#cookie-panda #cookie-accept").css({"color": "#fff"});
      }
    });

    jQuery("#cookie-panda #cookie-accept").on('mouseout', function(){
      jQuery("#cookie-panda #cookie-accept").css({"background-color": accept_bg_color, "border-color": accept_bg_color});

      if(accept_font_color !== ""){
        jQuery("#cookie-panda #cookie-accept").css({"color": accept_font_color});
      }else{
        jQuery("#cookie-panda #cookie-accept").css({"color": "#000"});
      }
    });
    
});