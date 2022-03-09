<?php
/**
* Plugin Name: Cookie Panda
* Plugin URI: https://shahidalionline.com/wordpress/plugins/cookie-panda
* Description: Simple GDPR cookie notice plugin for WordPress 
* Version: 1.2.0
* Author: Shahid Ali
* Author URI: https://shahidalionline.com
* License: GPLv2 or later
* License URI: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
* Text Domain: cookie-panda
* Requires at least: 4.9
* Tested up to: 5.8
* Requires PHP: 5.2.4
*
* This program is free software; you can redistribute it and/or modify it under the terms of the GNU
* General Public License version 2, as published by the Free Software Foundation. You may NOT assume
* that you can use any other version of the GPL.
*
* This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
* even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Invalid request.' );
}

if ( !class_exists( 'CookiePanda' ) ) :

include 'cookie-panda-widget.php';

class CookiePanda {

    private $name = 'Cookie Panda';
    private $slug = 'cookie-panda';
    private $version = '1.2.0';
    private $options = 'sao-cookie-panda';

    public function __construct() {
        self::load_files();
        self::widgetize();
    }

    public function load_files() {
        add_action( 'wp_enqueue_scripts', function() {
            wp_enqueue_script( $this->slug.'-script', plugins_url('js/script.js', __FILE__), array('jquery'), '1.0', true );
            wp_enqueue_style( $this->slug.'-style', plugins_url('css/style.css', __FILE__), null, '1.0' );
        });

        add_action( 'admin_enqueue_scripts', function() {
            if( !is_admin() ) return;
            wp_enqueue_style( 'wp-color-picker' ); 
            wp_enqueue_script( 'wp-color-picker-alpha', plugins_url( 'js/wp-color-picker-alpha.min.js',  __FILE__ ), array( 'wp-color-picker' ), '3.0.0', true );
            wp_enqueue_script( $this->slug.'-script', plugins_url('js/script.js', __FILE__), array( 'wp-color-picker-alpha' ), '3.0.0', true );
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