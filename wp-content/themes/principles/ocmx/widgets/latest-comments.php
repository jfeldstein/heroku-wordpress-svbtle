<?php
class ocmx_comment_widget extends WP_Widget {
    /** constructor */
    function ocmx_comment_widget() {
		$widget_ops = array('classname' => 'widget_recent_comments column' );
		$this->WP_Widget('ocmx_comment_widget', __("(Obox) Comments", 'ocmx'), $widget_ops);	
    }

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
        extract( $args );
		global $wpdb;
        $comment_count = esc_attr($instance["comment_count"]);
		$latest_comments = $wpdb->get_results($wpdb->prepare( "SELECT * FROM $wpdb->comments WHERE comment_approved = 1 ORDER BY comment_date DESC LIMIT ".$comment_count, "ARRAY_A") );
		echo $before_widget; ?>
        	<?php echo $before_title; ?><?php _e("Recent Comments", "ocmx"); ?><?php echo $after_title; ?>
  			<ul>
                <?php foreach($latest_comments as $latest_comment) : 
                    $this_comment = get_comment($latest_comment->comment_ID);
                    $use_id = $this_comment->comment_post_ID;
                    $this_post = get_post($use_id); 
                    $post_title = $this_post->post_title;
                    $post_link = get_permalink($this_comment->comment_post_ID);
                ?>
                <li>
                    <?php $use_comment = apply_filters('wp_texturize', $this_comment->comment_content);
                    $comment_length = strlen(strip_tags($use_comment));
                    $use_comment = strip_tags(substr($use_comment, 0 , 100));
                    if($comment_length > 100) : $use_comment .= "..."; endif;
                    echo $use_comment; ?>
                    <a href="<?php echo $post_link; ?>#comment-<?php echo $this_comment->comment_ID; ?>"><?php echo $this_comment->comment_author; ?> <span>in</span> <?php echo $post_title; ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?php echo $after_widget; ?>
<?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;
    }

    /** @see WP_Widget::form */
    function form($instance) {
        $defaults = array( 'comment_count' => ''); 
        $instance = wp_parse_args( (array) $instance, $defaults );
        $comment_count = esc_attr($instance["comment_count"]);
		
        ?>
            <p>
            	<label for="<?php echo $this->get_field_id('comment_count'); ?>">Comment Count</label>
                <select size="1" class="widefat" id="<?php echo $this->get_field_id('comment_count'); ?>" name="<?php echo $this->get_field_name('comment_count'); ?>">
                	<?php for($i = 1; $i < 10; $i++) : ?>
	                    <option <?php if($comment_count == $i) : ?>selected="selected"<?php endif; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                    <?php endfor; ?>
                </select>
			</p>
<?php 
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("ocmx_comment_widget");'));

?>
