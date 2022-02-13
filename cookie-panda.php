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

class CookiePanda {

    private $name = 'Cookie Panda';
    private $slug = 'cookie-panda';
    private $version = '1.0.0';
    private $options = 'sao-cookie-panda';
    private $shortcode = 'cookiepanda';

    public function __construct() {

        self::load_files();
        add_shortcode( $this->shortcode, array( $this, 'displayForm' ) );
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

    public function displayForm() {
        add_action( 'wp_footer', function() {
            ob_start()
            ?>
                <div id="cookie-panda">
                    <div class="row">
                        <div class="col-12 col-md-10">
                            <div class="widget">
                                <p>
                                    Ce site utilise des cookies pour améliorer votre expérience et vous fournir un contenu personnalisé. Si vous continuez à naviguer sur notre site Web, vous acceptez notre utilisation des cookies.
                                </p>
                            </div>
                        </div>
                        <div class="col-12 col-md-2 cookie-btn-wrapper"> 
                            <a href="#" id="cookie-accept" class="btn">J'accepte</a>
                        </div>
                    </div>
                </div>
            <?php
            $output = ob_get_clean();
            echo $output;
        });
        
    }

}

$CookiePanda = new CookiePanda();

endif;