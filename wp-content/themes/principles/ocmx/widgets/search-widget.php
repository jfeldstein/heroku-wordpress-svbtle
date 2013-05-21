<?php
class searchbox_widget extends WP_Widget {
	
	function searchbox_widget() {
		$widget_ops = array('classname' => 'search-form', 'description' => __( "(Obox) Search", "ocmx") );
		$this->WP_Widget('search', __("(Obox) Search","ocmx"), $widget_ops);
	}

    /** @see WP_Widget::widget */
    function widget($args, $instance) {		
		$title = $instance["title"];
?>
	<li class="widget search-form column">
        <form action="<?php echo home_url(); ?>" method="get" class="search-form">
            <input type="text" name="s" id="s" class="search" maxlength="50" value="<?php the_search_query(); ?>" />
            <input type="submit" class="search_button" value="<?php _e("Search", "ocmx"); ?>" />
        </form>
	</li>
<?php
    }

    /** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
        return $new_instance;

   			
	} // form

}// class

//This sample widget can then be registered in the widgets_init hook:

// register FooWidget widget
add_action('widgets_init', create_function('', 'return register_widget("searchbox_widget");'));

?>