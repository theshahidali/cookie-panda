<?php
/**
 * CookiePandaWidget
 */

if ( ! defined( 'ABSPATH' ) ) {
    die( 'Invalid request.' );
}

class CookiePandaWidget extends WP_Widget {

    public $id = 'cookie_panda_widget';
  
    function __construct() {
        parent::__construct( 
            $this->id, 
            __('Cookie Panda', 'cookie-panda'), 
            array( 'description' => __( 'Simple GDPR cookie notice plugin for WordPress', 'cookie-panda' ) ) 
        );
    }
      
    public function widget( $args, $instance ) {
        if( isset($instance['cookie_notice']) && !empty($instance['cookie_notice']) ){
            echo $args['before_widget'];
            ob_start();
            ?>
                <div id="cookie-panda">
                    <div class="cookie-text-wrapper">
                        <p><small><?php echo esc_html( $instance['cookie_notice'] ); ?></small></p>
                    </div>
                    <div class="cookie-btn-wrapper">
                        <?php if( isset($instance['privacy_link']) && !empty($instance['privacy_link']) ){ ?>
                            <a href="<?php echo esc_html( $instance['privacy_link'] ) ?>" id="privacy_link" class="btn" target="_blank">
                                <?php 
                                    if( isset($instance['privacy_label']) && !empty($instance['privacy_label']) ) {
                                        echo esc_html( $instance['privacy_label'] );
                                    }else{
                                        esc_html_e( 'Privacy policy', 'cookie-panda' );
                                    }
                                ?>
                            </a>
                        <?php } ?>
                        <a href="#" id="cookie-accept" class="btn">
                            <?php 
                                if( isset($instance['accept_label']) && !empty($instance['accept_label']) ) {
                                    echo esc_html( $instance['accept_label'] );
                                }else{
                                    esc_html_e( 'Accept', 'cookie-panda' );
                                }
                            ?>
                        </a>
                    </div>
                </div>
            <?php
            echo ob_get_clean();
            echo $args['after_widget'];
        }
    }
              
    public function form( $instance ) {
        $cookie_notice = "";
        if( isset($instance['cookie_notice']) ) $cookie_notice = $instance['cookie_notice'];
        $accept_label = "Accept";
        if( isset($instance['accept_label']) && !empty($instance['accept_label'])) $accept_label = $instance['accept_label'];
        $privacy_label = "Privacy policy";
        if( isset($instance['privacy_label']) && !empty($instance['privacy_label'])) $privacy_label = $instance['privacy_label'];
        $privacy_link = "";
        if( isset($instance['privacy_link']) && !empty($instance['privacy_link'])) $privacy_link = $instance['privacy_link'];

        ?>
            <p>
                <label for="<?php echo $this->get_field_id('cookie_notice')?>"><?php _e('Cookie Notice')?></label>
                <textarea id="<?php echo $this->get_field_id('cookie_notice')?>" name="<?php echo $this->get_field_name('cookie_notice') ?>" value="<?php echo esc_attr( $cookie_notice ); ?>" class="widefat"><?php echo esc_textarea( $cookie_notice ); ?></textarea>
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('accept_label')?>"><?php _e('Accept button label')?></label>
                <input type="text" id="<?php echo $this->get_field_id('accept_label')?>" name="<?php echo $this->get_field_name('accept_label') ?>" value="<?php echo esc_attr( $accept_label ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('privacy_label')?>"><?php _e('Privacy button label')?></label>
                <input type="text" id="<?php echo $this->get_field_id('privacy_label')?>" name="<?php echo $this->get_field_name('privacy_label') ?>" value="<?php echo esc_attr( $privacy_label ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo $this->get_field_id('privacy_link')?>"><?php _e('Privacy link')?></label>
                <input type="text" id="<?php echo $this->get_field_id('privacy_link')?>" name="<?php echo $this->get_field_name('privacy_link') ?>" value="<?php echo esc_attr( $privacy_link ); ?>" class="widefat">
            </p>
        <?php 
    }
          
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['cookie_notice'] = ( !empty( $new_instance['cookie_notice'] ) ) ? strip_tags( $new_instance['cookie_notice'] ) : '';
        $instance['accept_label'] = ( !empty( $new_instance['accept_label'] ) ) ? strip_tags( $new_instance['accept_label'] ) : '';
        $instance['privacy_label'] = ( !empty( $new_instance['privacy_label'] ) ) ? strip_tags( $new_instance['privacy_label'] ) : '';
        $instance['privacy_link'] = ( !empty( $new_instance['privacy_link'] ) ) ? strip_tags( $new_instance['privacy_link'] ) : '';
        return $instance;
    }
} 