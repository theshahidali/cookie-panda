<?php
/**
* Plugin Name: Cookie Panda
* Plugin URI: https://shahidalionline.com/wordpress/plugins/cookie-panda
* Description: Simple GDPR cookie notice plugin for WordPress 
* Version: 1.0.0
* Text Domain: cookie-panda
* Author: Shahid Ali
* Author URI: https://shahidalionline.com
*/

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Invalid request.' );
}

if ( !class_exists( 'CookiePanda' ) ) :

include 'cookie-panda-widget.php';

class CookiePanda {

    private $name = 'Cookie Panda';
    private $slug = 'cookie-panda';
    private $version = '1.0.0';
    private $options = 'sao-cookie-panda';
    private $shortcode = 'cookiepanda';

    public function __construct() {
        self::load_files();
        self::widgetize();
    }

    public function load_files() {
        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_script( $this->slug.'-script', plugins_url('js/script.js', __FILE__), array('jquery'), '1.0', true );
            wp_enqueue_style( $this->slug.'-style', plugins_url('css/style.css', __FILE__), null, '1.0' );
        });
    }

    public static function get_name() {
        return $this->name;
    }

    public static function get_version() {
        return $this->version;
    }

    public function widgetize(){
        $CookiePandaWidget = new CookiePandaWidget();

        add_action( 'widgets_init', function() {
            register_widget( 'CookiePandaWidget' );
        });

        register_sidebar(array(
            'name' => $this->name,
            'id'   => $this->slug.'-sidebar',
            'before_widget' => '<div class="'.$this->slug.'-sidebar">',
            'after_widget'  => '</div>'
        ));

        add_action( 'wp_footer', function() {
            dynamic_sidebar($this->slug.'-sidebar');
        });
    }
}

$CookiePanda = new CookiePanda();
endif;