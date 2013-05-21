<?php
class ocmx_twitter_widget extends WP_Widget {
    /** constructor */
    function ocmx_twitter_widget() {
        parent::WP_Widget(false, $name = __('(Obox) Twitter Stream', 'ocmx'), $widget_options = __('Display your latest Tweets.','ocmx'));	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
        $twitter_key = $instance["twitter_id"];
        $twitter_count = $instance["twitter_count"];
		$retweets = $instance["retweets"];
		$twitter_replies = $instance["twitter_replies"];
		echo $before_widget; ?>
			<?php echo $before_title; ?>
            	<a href="http://www.twitter.com/<?php echo $twitter_key; ?>" target="_blank"><?php echo $instance['title']; ?></a>
            <?php echo $after_title; ?>
			<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/scripts/chirp.min.js"></script>
            <script>
				Chirp({
  					user: '<?php echo $twitter_key; ?>', //Twitter username
  					max: <?php echo $twitter_count; ?>, //Maximum number of tweets to show 
					count: 10, //Total tweets to retrieve
  					retweets: <?php echo $retweets; ?>, //Show/Don't show retweets
  					replies: <?php echo $twitter_replies; ?>,  //Show/Don't show replies
  					cacheExpire: 1000 * 60 * 2 //Number of milliseconds to cache tweets
					})
			</script>
        <?php echo $after_widget;
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {				
        $defaults = array( 'title' => '', 'twitter_id' => '', 'twitter_count' => '', 'retweets' => true, 'twitter_replies' => true); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        
        $title = esc_attr($instance["title"]);
        $twitter_id = esc_attr($instance["twitter_id"]);
        $twitter_count = esc_attr($instance["twitter_count"]);
		$retweets = $instance["retweets"];
		$twitter_replies = $instance["twitter_replies"];
		
        ?>
            <p><label for="<?php echo $this->get_field_id('title'); ?>">Title<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" /></label></p>
            <p><label for="<?php echo $this->get_field_id('twitter_id'); ?>">Twitter ID<input class="widefat" id="<?php echo $this->get_field_id('twitter_id'); ?>" name="<?php echo $this->get_field_name('twitter_id'); ?>" type="text" value="<?php echo $twitter_id; ?>" /></label></p>
			<p>
            	<label for="<?php echo $this->get_field_id('twitter_count'); ?>">Tweet Count
                <select size="1" class="widefat" id="<?php echo $this->get_field_id('twitter_count'); ?>" name="<?php echo $this->get_field_name('twitter_count'); ?>">
                    <option <?php if($twitter_count == "1") : ?>selected="selected"<?php endif; ?> value="1">1</option>
                    <option <?php if($twitter_count == "2") : ?>selected="selected"<?php endif; ?> value="2">2</option>
                    <option <?php if($twitter_count == "3") : ?>selected="selected"<?php endif; ?> value="3">3</option>
                    <option <?php if($twitter_count == "4") : ?>selected="selected"<?php endif; ?> value="4">4</option>
                    <option <?php if($twitter_count == "6") : ?>selected="selected"<?php endif; ?> value="6">6</option>
                    <option <?php if($twitter_count == "8") : ?>selected="selected"<?php endif; ?> value="8">8</option>
                    <option <?php if($twitter_count == "10") : ?>selected="selected"<?php endif; ?> value="10">10</option>
                </select>
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('retweets'); ?>">Show Retweets?</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('retweets'); ?>" name="<?php echo $this->get_field_name('retweets'); ?>">
					<option <?php if($retweets == "true") : ?>selected="selected"<?php endif; ?> value="true">Yes</option>
					<option <?php if($retwets == "false") : ?>selected="selected"<?php endif; ?> value="false">No</option>
				</select>
			</p>
            <p>
				<label for="<?php echo $this->get_field_id('twitter_replies'); ?>">Show @Replies?</label>
				<select size="1" class="widefat" id="<?php echo $this->get_field_id('twitter_replies'); ?>" name="<?php echo $this->get_field_name('twitter_replies'); ?>">
					<option <?php if($twitter_replies == "true") : ?>selected="selected"<?php endif; ?> value="true">Yes</option>
					<option <?php if($twitter_replies == "false") : ?>selected="selected"<?php endif; ?> value="false">No</option>
				</select>
			</p>
        <?php 
    }

} // class FooWidget

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ocmx_twitter_widget");'));
?>