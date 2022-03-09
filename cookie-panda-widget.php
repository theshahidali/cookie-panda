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

            $notice_styles = '';
            if( isset($instance['notice_bg_color']) && !empty($instance['notice_bg_color']) ){
                $notice_styles .= "background-color:".$instance['notice_bg_color'].";";
            }
            if( isset($instance['notice_font_color']) && !empty($instance['notice_font_color']) ){
                $notice_styles .= "color:".$instance['notice_font_color'].";";
            }

            $text_styles = 'inherit';
            if( isset($instance['notice_font_size']) && !empty($instance['notice_font_size']) ){
                $text_styles = "font-size:".$instance['notice_font_size']."px;";
            }

            $privacy_bg_color = '';
            if( isset($instance['privacy_bg_color']) && !empty($instance['privacy_bg_color']) ){
                $privacy_bg_color = $instance['privacy_bg_color'];
            }
            $privacy_font_color = '';
            if( isset($instance['privacy_font_color']) && !empty($instance['privacy_font_color']) ){
                $privacy_font_color = $instance['privacy_font_color'];
            }

            $accept_bg_color = '';
            if( isset($instance['accept_bg_color']) && !empty($instance['accept_bg_color']) ){
                $accept_bg_color = $instance['accept_bg_color'];
            }
            $accept_font_color = '';
            if( isset($instance['accept_font_color']) && !empty($instance['accept_font_color']) ){
                $accept_font_color = $instance['accept_font_color'];
            }

            ob_start();
            ?>
                <div id="cookie-panda" style='<?php echo esc_attr( $notice_styles ) ?>'>
                    <div class="cookie-text-wrapper" style='<?php echo esc_attr( $text_styles ) ?>'>
                        <?php echo esc_html( $instance['cookie_notice'] ); ?>
                    </div>
                    <div class="cookie-btn-wrapper">
                        <?php if( isset($instance['privacy_link']) && !empty($instance['privacy_link']) ){ ?>
                            <a 
                            href="<?php echo esc_html( $instance['privacy_link'] ) ?>" 
                            id="privacy_link" 
                            class="btn" 
                            target="_blank"
                            data-bg="<?php echo esc_attr($privacy_bg_color) ?>"
                            data-font="<?php echo esc_attr($privacy_font_color) ?>"
                            >
                                <?php 
                                    if( isset($instance['privacy_label']) && !empty($instance['privacy_label']) ) {
                                        echo esc_html( $instance['privacy_label'] );
                                    }else{
                                        esc_html_e( 'Privacy policy', 'cookie-panda' );
                                    }
                                ?>
                            </a>
                        <?php } ?>
                        <a href="#" 
                        id="cookie-accept" 
                        class="btn"
                        data-bg="<?php echo esc_attr($accept_bg_color) ?>"
                        data-font="<?php echo esc_attr($accept_font_color) ?>"
                        >
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
        $notice_bg_color = "#000000cc";
        if( isset($instance['notice_bg_color']) && !empty($instance['notice_bg_color'])) $notice_bg_color = $instance['notice_bg_color'];
        $notice_font_color = "#ffffff";
        if( isset($instance['notice_font_color']) && !empty($instance['notice_font_color'])) $notice_font_color = $instance['notice_font_color'];
        $notice_font_size = "";
        if( isset($instance['notice_font_size']) && !empty($instance['notice_font_size'])) $notice_font_size = $instance['notice_font_size'];
        $privacy_bg_color = "#ffffff";
        if( isset($instance['privacy_bg_color']) && !empty($instance['privacy_bg_color'])) $privacy_bg_color = $instance['privacy_bg_color'];
        $privacy_font_color = "#000000";
        if( isset($instance['privacy_font_color']) && !empty($instance['privacy_font_color'])) $privacy_font_color = $instance['privacy_font_color'];
        $accept_bg_color = "#ffffff";
        if( isset($instance['accept_bg_color']) && !empty($instance['accept_bg_color'])) $accept_bg_color = $instance['accept_bg_color'];
        $accept_font_color = "#000000";
        if( isset($instance['accept_font_color']) && !empty($instance['accept_font_color'])) $accept_font_color = $instance['accept_font_color'];
        ?>
            <p>
                <label for="<?php echo esc_attr($this->get_field_id('cookie_notice'))?>"><?php echo esc_html('Cookie Notice')?></label>
                <textarea id="<?php echo esc_attr($this->get_field_id('cookie_notice'))?>" name="<?php echo esc_attr($this->get_field_name('cookie_notice')) ?>" value="<?php echo esc_attr( $cookie_notice ); ?>" class="widefat"><?php echo esc_textarea( $cookie_notice ); ?></textarea>
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('accept_label'))?>"><?php echo esc_html('Accept button label')?></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id('accept_label'))?>" name="<?php echo esc_attr($this->get_field_name('accept_label')) ?>" value="<?php echo esc_attr( $accept_label ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('privacy_label'))?>"><?php echo esc_html('Privacy button label')?></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id('privacy_label'))?>" name="<?php echo esc_attr($this->get_field_name('privacy_label')) ?>" value="<?php echo esc_attr( $privacy_label ); ?>" class="widefat">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('privacy_link'))?>"><?php echo esc_html('Privacy link')?></label>
                <input type="text" id="<?php echo esc_attr($this->get_field_id('privacy_link'))?>" name="<?php echo esc_attr($this->get_field_name('privacy_link')) ?>" value="<?php echo esc_attr( $privacy_link ); ?>" class="widefat">
            </p>

            <hr/>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('notice_bg_color'))?>"><b><?php echo esc_html('Notice background color:')?></b></label>
                <input type="text" data-alpha-enabled="true" id="<?php echo esc_attr($this->get_field_id('notice_bg_color'))?>" name="<?php echo esc_attr($this->get_field_name('notice_bg_color')) ?>" value="<?php echo esc_attr( $notice_bg_color ); ?>" class="wp-color-picker">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('notice_font_color'))?>"><b><?php echo esc_html('Notice font color:')?></b></label>
                <input type="text" data-alpha-enabled="false" id="<?php echo esc_attr($this->get_field_id('notice_font_color'))?>" name="<?php echo esc_attr($this->get_field_name('notice_font_color')) ?>" value="<?php echo esc_attr( $notice_font_color ); ?>" class="wp-color-picker">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('notice_font_size'))?>"><b><?php echo esc_html('Notice font size (px):')?></b></label>
                <input type="number" min="1" id="<?php echo esc_attr($this->get_field_id('notice_font_size'))?>" name="<?php echo esc_attr($this->get_field_name('notice_font_size')) ?>" value="<?php echo esc_attr( $notice_font_size ); ?>" class="widefat">
            </p>

            <hr/>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('privacy_bg_color'))?>"><b><?php echo esc_html('Privacy button background:')?></b></label>
                <input type="text" data-alpha-enabled="true" id="<?php echo esc_attr($this->get_field_id('privacy_bg_color'))?>" name="<?php echo esc_attr($this->get_field_name('privacy_bg_color')) ?>" value="<?php echo esc_attr( $privacy_bg_color ); ?>" class="wp-color-picker">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('privacy_font_color'))?>"><b><?php echo esc_html('Privacy button font color:')?></b></label>
                <input type="text" data-alpha-enabled="false" id="<?php echo esc_attr($this->get_field_id('privacy_font_color'))?>" name="<?php echo esc_attr($this->get_field_name('privacy_font_color')) ?>" value="<?php echo esc_attr( $privacy_font_color ); ?>" class="wp-color-picker">
            </p>
            
            <hr/>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('accept_bg_color'))?>"><b><?php echo esc_html('Accept button background:')?></b></label>
                <input type="text" data-alpha-enabled="true" id="<?php echo esc_attr($this->get_field_id('accept_bg_color'))?>" name="<?php echo esc_attr($this->get_field_name('accept_bg_color')) ?>" value="<?php echo esc_attr( $accept_bg_color ); ?>" class="wp-color-picker">
            </p>

            <p>
                <label for="<?php echo esc_attr($this->get_field_id('accept_font_color'))?>"><b><?php echo esc_html('Accept button font color:')?></b></label>
                <input type="text" data-alpha-enabled="false" id="<?php echo esc_attr($this->get_field_id('accept_font_color'))?>" name="<?php echo esc_attr($this->get_field_name('accept_font_color')) ?>" value="<?php echo esc_attr( $accept_font_color ); ?>" class="wp-color-picker">
            </p>

            <hr/>
            <p>If you like the plugin <a href="https://wordpress.org/plugins/cookie-panda/#reviews" target="_blank">Rate it on WordPress.org</a><p>
            <p>For quick support & updates <a href="https://web.facebook.com/groups/wppandaplugins" target="_blank">Join our Facebook group</a></p>
            <p>Need help with WordPress? <a href="https://shahidalionline.com" target="_blank">Contact me on shahidalionline.com</a></p>
            <br>
        <?php 
    }
          
    public function update( $new_instance, $old_instance ) {
        $instance = array();
        $instance['cookie_notice'] = ( !empty( $new_instance['cookie_notice'] ) ) ? strip_tags( $new_instance['cookie_notice'] ) : '';
        $instance['accept_label'] = ( !empty( $new_instance['accept_label'] ) ) ? strip_tags( $new_instance['accept_label'] ) : '';
        $instance['privacy_label'] = ( !empty( $new_instance['privacy_label'] ) ) ? strip_tags( $new_instance['privacy_label'] ) : '';
        $instance['privacy_link'] = ( !empty( $new_instance['privacy_link'] ) ) ? strip_tags( $new_instance['privacy_link'] ) : '';
        $instance['notice_bg_color'] = ( !empty( $new_instance['notice_bg_color'] ) ) ? strip_tags( $new_instance['notice_bg_color'] ) : '';
        $instance['notice_font_color'] = ( !empty( $new_instance['notice_font_color'] ) ) ? strip_tags( $new_instance['notice_font_color'] ) : '';
        $instance['notice_font_size'] = ( !empty( $new_instance['notice_font_size'] ) ) ? strip_tags( $new_instance['notice_font_size'] ) : '';
        $instance['privacy_bg_color'] = ( !empty( $new_instance['privacy_bg_color'] ) ) ? strip_tags( $new_instance['privacy_bg_color'] ) : '';
        $instance['privacy_font_color'] = ( !empty( $new_instance['privacy_font_color'] ) ) ? strip_tags( $new_instance['privacy_font_color'] ) : '';
        $instance['accept_bg_color'] = ( !empty( $new_instance['accept_bg_color'] ) ) ? strip_tags( $new_instance['accept_bg_color'] ) : '';
        $instance['accept_font_color'] = ( !empty( $new_instance['accept_font_color'] ) ) ? strip_tags( $new_instance['accept_font_color'] ) : '';
        return $instance;
    }
} 