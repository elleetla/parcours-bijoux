<?php
/*
 * Ohouais Social Profiles Widget
 */

class ohouais_socials extends WP_Widget {

    public function __construct() {        
        $widget_ops = array( 'classname' => 'fl-socials', 'description' => 'Links social media profiles' );
        parent::__construct(
            'Ohouais_Socials',  // Base ID
            'Ohouais - Socials', // Name
            $widget_ops
        );
    }

    /**
     * Front-end display of widget.
     */
    public function widget($args, $instance) {
        extract($args);
        $title = apply_filters('widget_title', $instance['title']);
        $behance = $instance['behance'];
        $delicious = $instance['delicious'];
        $deviantart = $instance['deviantart'];
        $digg = $instance['digg'];
        $dribbble = $instance['dribbble'];
        $facebook = $instance['facebook'];
        $flickr = $instance['flickr'];
        $google = $instance['google'];
        $instagram = $instance['instagram'];
        $linkedin = $instance['linkedin'];
        $rss = $instance['rss'];
        $soundcloud = $instance['soundcloud'];
        $tumblr = $instance['tumblr'];        
        $twitter = $instance['twitter'];
        $vimeo = $instance['vimeo'];
        $youtube = $instance['youtube'];
		$pinterest = $instance['pinterest'];
		
        // social profile link
        $behance_profile = '<a target="_blank" href="' . esc_url( $behance ) . '"><i class="fa fa-behance"></i></a>';
        $delicious_profile = '<a target="_blank" href="' . esc_url( $delicious ) . '"><i class="fa fa-delicious"></i></a>';
        $deviantart_profile = '<a target="_blank" href="' . esc_url( $deviantart ) . '"><i class="fa fa-deviantart"></i></a>';
        $digg_profile = '<a target="_blank" href="' . esc_url( $digg ) . '"><i class="fa fa-digg"></i></a>';
        $dribbble_profile = '<a target="_blank" href="' . esc_url( $dribbble ) . '"><i class="fa fa-dribbble"></i></a>';
        $facebook_profile = '<a target="_blank" target="_blank" href="' . esc_url( $facebook ) . '"><i class="fa fa-facebook"></i></a>';
        $flickr_profile = '<a target="_blank" href="' . esc_url( $flickr ) . '"><i class="fa fa-flickr"></i></a>';
        $google_profile = '<a target="_blank" href="' . esc_url( $google ) . '"><i class="fa fa-google-plus"></i></a>';
        $instagram_profile = '<a target="_blank" href="' . esc_url( $instagram ) . '"><i class="fa fa-instagram"></i></a>';
        $linkedin_profile = '<a target="_blank" href="' . esc_url( $linkedin ) . '"><i class="fa fa-linkedin"></i></a>';
        $rss_profile = '<a target="_blank" href="' . esc_url( $rss ) . '"><i class="fa fa-rss"></i></a>';
        $soundcloud_profile = '<a target="_blank" href="' . esc_url( $soundcloud ) . '"><i class="fa fa-soundcloud"></i></a>';
        $tumblr_profile = '<a target="_blank" href="' . esc_url( $tumblr ) . '"><i class="fa fa-tumblr"></i></a>';
        $twitter_profile = '<a target="_blank" href="' . esc_url( $twitter ) . '"><i class="fa fa-twitter"></i></a>';
        $vimeo_profile = '<a target="_blank" href="' . esc_url( $vimeo ) . '"><i class="fa fa-vimeo"></i></a>';
        $youtube_profile = '<a target="_blank" href="' . esc_url( $youtube ) . '"><i class="fa fa-youtube"></i></a>';
        $pinterest_profile = '<a target="_blank" href="' . esc_url( $pinterest ) . '"><i class="fa fa-pinterest-p"></i></a>';
        echo ( $args['before_widget'] );

        if (!empty($title)) {
            echo ( $args['before_title'] . $title . $args['after_title'] );
        }

        echo '<div class="social-icons">';
        echo (!empty($behance) ) ? $behance_profile : null;
        echo (!empty($delicious) ) ? $delicious_profile : null;
        echo (!empty($deviantart) ) ? $deviantart_profile : null;
        echo (!empty($digg) ) ? $digg_profile : null;
        echo (!empty($dribbble) ) ? $dribbble_profile : null;
        echo (!empty($facebook) ) ? $facebook_profile : null;
        echo (!empty($flickr) ) ? $flickr_profile : null;
        echo (!empty($google) ) ? $google_profile : null;
        echo (!empty($instagram) ) ? $instagram_profile : null;
        echo (!empty($linkedin) ) ? $linkedin_profile : null;
        echo (!empty($rss) ) ? $rss_profile : null;
        echo (!empty($soundcloud) ) ? $soundcloud_profile : null;
        echo (!empty($tumblr) ) ? $tumblr_profile : null;
        echo (!empty($twitter) ) ? $twitter_profile : null;
        echo (!empty($vimeo) ) ? $vimeo_profile : null;
        echo (!empty($youtube) ) ? $youtube_profile : null;
        echo (!empty($pinterest) ) ? $pinterest_profile : null;
        echo '</div>';

        echo ( $args['after_widget'] );
    }

    /**
     * Back-end widget form.
     */
    public function form($instance) {
        $instance = wp_parse_args( (array) $instance, array( 
            'title' => '',
            'behance' => '',
            'delicious' => '',
            'deviantart'  => '',
            'digg'  => '',
            'dribbble' => '',
            'facebook'  => '',
            'flickr' => '',
            'google'  => '',
            'instagram' => '',
            'linkedin'  => '',
            'rss'  => '',
            'soundcloud' => '',
            'tumblr'  => '',
            'twitter'  => '',
            'vimeo' => '',
            'youtube'  => '',
            'pinterest'  => '',
            ) );
        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php echo 'Title:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('behance') ); ?>"><?php echo 'Behance:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('behance') ); ?>" name="<?php echo esc_attr( $this->get_field_name('behance') ); ?>" type="text" value="<?php echo esc_url( $instance['behance'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('delicious') ); ?>"><?php echo 'Delicious:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('delicious') ); ?>" name="<?php echo esc_attr( $this->get_field_name('delicious') ); ?>" type="text" value="<?php echo esc_url( $instance['delicious'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('deviantart') ); ?>"><?php echo 'Deviantart:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('deviantart') ); ?>" name="<?php echo esc_attr( $this->get_field_name('deviantart') ); ?>" type="text" value="<?php echo esc_url( $instance['deviantart'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('digg') ); ?>"><?php echo 'Digg:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('digg') ); ?>" name="<?php echo esc_attr( $this->get_field_name('digg') ); ?>" type="text" value="<?php echo esc_url( $instance['digg'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>"><?php echo 'Dribbble:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('dribbble') ); ?>" name="<?php echo esc_attr( $this->get_field_name('dribbble') ); ?>" type="text" value="<?php echo esc_url( $instance['dribbble'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>"><?php echo 'Facebook:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('facebook') ); ?>" name="<?php echo esc_attr( $this->get_field_name('facebook') ); ?>" type="text" value="<?php echo esc_url( $instance['facebook'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>"><?php echo 'Flickr:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('flickr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('flickr') ); ?>" type="text" value="<?php echo esc_url( $instance['flickr'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('google') ); ?>"><?php echo 'Google+:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('google') ); ?>" name="<?php echo esc_attr( $this->get_field_name('google') ); ?>" type="text" value="<?php echo esc_url( $instance['google'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>"><?php echo 'Instagram:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('instagram') ); ?>" name="<?php echo esc_attr( $this->get_field_name('instagram') ); ?>" type="text" value="<?php echo esc_url( $instance['instagram'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>"><?php echo 'Linkedin:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('linkedin') ); ?>" name="<?php echo esc_attr( $this->get_field_name('linkedin') ); ?>" type="text" value="<?php echo esc_url( $instance['linkedin'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('rss') ); ?>"><?php echo 'RSS:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('rss') ); ?>" name="<?php echo esc_attr( $this->get_field_name('rss') ); ?>" type="text" value="<?php echo esc_url( $instance['rss'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('soundcloud') ); ?>"><?php echo 'Soundcloud:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('soundcloud') ); ?>" name="<?php echo esc_attr( $this->get_field_name('soundcloud') ); ?>" type="text" value="<?php echo esc_url( $instance['soundcloud'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('tumblr') ); ?>"><?php echo 'Tumblr:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('tumblr') ); ?>" name="<?php echo esc_attr( $this->get_field_name('tumblr') ); ?>" type="text" value="<?php echo esc_url( $instance['tumblr'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>"><?php echo 'Twitter:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('twitter') ); ?>" name="<?php echo esc_attr( $this->get_field_name('twitter') ); ?>" type="text" value="<?php echo esc_url( $instance['twitter'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('vimeo') ); ?>"><?php echo 'Vimeo:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('vimeo') ); ?>" name="<?php echo esc_attr( $this->get_field_name('vimeo') ); ?>" type="text" value="<?php echo esc_url( $instance['vimeo'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>"><?php echo 'Youtube:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('youtube') ); ?>" name="<?php echo esc_attr( $this->get_field_name('youtube') ); ?>" type="text" value="<?php echo esc_url( $instance['youtube'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>"><?php echo 'Pinterest:'; ?></label><br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('pinterest') ); ?>" name="<?php echo esc_attr( $this->get_field_name('pinterest') ); ?>" type="text" value="<?php echo esc_url( $instance['pinterest'] ); ?>">
        </p>

        <?php
    }

    /**
     * Sanitize widget form values as they are saved.
     */
    public function update($new_instance, $old_instance) {
        $instance = $old_instance;

        $instance['title']      = strip_tags( $new_instance['title'] );
        $instance['behance']    = $new_instance['behance'];
        $instance['delicious']  = $new_instance['delicious'];
        $instance['deviantart'] = $new_instance['deviantart'];
        $instance['digg']       = $new_instance['digg'];
        $instance['dribbble']   = $new_instance['dribbble'];
        $instance['facebook']   = $new_instance['facebook'];
        $instance['flickr']     = $new_instance['flickr'];
        $instance['google']     = $new_instance['google'];
        $instance['instagram']  = $new_instance['instagram'];
        $instance['linkedin']   = $new_instance['linkedin'];
        $instance['rss']        = $new_instance['rss'];
        $instance['soundcloud'] = $new_instance['soundcloud'];
        $instance['tumblr']     = $new_instance['tumblr'];
        $instance['twitter']    = $new_instance['twitter'];
        $instance['vimeo']      = $new_instance['vimeo'];
        $instance['youtube']    = $new_instance['youtube'];
        $instance['pinterest']    = $new_instance['pinterest'];

        return $instance;
    }

}

// register widget
function ohouais_socials_widget() {
    register_widget('ohouais_socials');
}

add_action('widgets_init', 'ohouais_socials_widget');

