<?php
if ( ! defined( 'ABSPATH' ) ) {
    die( 'Invalid request.' );
}

class CookiePandaWidget extends WP_Widget {

    public $id = 'cookie_panda_widget';
    public $name = 'Cookie Panda';
    public $domain = 'cookie_panda_widget_domain';
    public $description = 'Simple GDPR cookie notice plugin for WordPress';
  
    function __construct() {
        parent::__construct( 
            $this->id, 
            __($this->name, $this->domain), 
            array( 'description' => __( $this->description, $this->domain ) ) 
        );
    }
      
    public function widget( $args, $instance ) {
        if( isset($instance['cookie_notice']) && !empty($instance['cookie_notice']) ){
            echo $args['before_widget'];
            ob_start();
            ?>
                <div id="cookie-panda">
                    <div class="cookie-text-wrapper">
                        <p><small><?php echo __( $instance['cookie_notice'], $this->domain ); ?></small></p>
                    </div>
                    <div class="cookie-btn-wrapper">
                        <?php if( isset($instance['privacy_link']) && !empty($instance['privacy_link']) ){ ?>
                            <a href="<?php echo $instance['privacy_link'] ?>" id="privacy_link" class="btn" target="_blank">
                                <?php 
                                    if( isset($instance['privacy_label']) && !empty($instance['privacy_label']) ) {
                                        echo __( $instance['privacy_label'], $this->domain );
                                    }else{
                                        echo __( 'Privacy policy', $this->domain );
                                    }
                                ?>
                            </a>
                        <?php } ?>
                        <a href="#" id="cookie-accept" class="btn">
                            <?php 
                                if( isset($instance['accept_label']) && !empty($instance['accept_label']) ) {
                                    echo __( $instance['accept_label'], $this->domain );
                                }else{
                                    echo __( 'Accept', $this->domain );
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
                <textarea id="<?php echo $this->get_field_id('cookie_notice')?>" name="<?php echo $this->get_field_name('cookie_notice') ?>" value="<?php echo esc_attr( $cookie_notice ); ?>" class="widefat"><?php echo esc_attr( $cookie_notice ); ?></textarea>
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