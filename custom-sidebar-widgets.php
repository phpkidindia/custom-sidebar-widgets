<?php
/*
Plugin Name: Custom Sidebar Widgets
Plugin URI: http://www.dgsoftek.com/
Description: Custom Sidebar Widgets plugin for adding custom styled links.
Version: 1.0
Author: Ashok G
Author URI: http://www.about.me/ashok.g
License: GPL
*/

?>
<?php 
add_action( 'widgets_init', 'custom_sidebar_load_widgets' );
function custom_sidebar_load_widgets() {
	register_widget( 'Custom_Sidebar_Widgets' );
}

class Custom_Sidebar_Widgets extends WP_Widget{
		function Custom_Sidebar_Widgets() {
		/* Widget Settings */
		$widget_ops = array( 'classname' => 'cs_bar', 'description' => __('A custom sidebar widget.', 'cs_bar') );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'cs_bar_widget' );

		/* Create the widget. */
		$this->WP_Widget( 'cs_bar_widget', __('Custom sidebar Widget', 'cs_bar'), $widget_ops, $control_ops );

}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$link_url = $instance['link_url'];
		$link_class = $instance['link_class'];
		$link_rel = $instance['link_rel'];
		$link_img = $instance['link_img'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		
		/* Display name from widget settings if one was input. */
		printf('<a class="%1$s" rel="%5$s" href="%2$s"><div style="background: url(%3$s) no-repeat scroll center top transparent; cursor: pointer;   float: left; margin: 10px 0 0;" ><div class="quicklink_txt5">%4$s</div></div></a><br>',$link_class,$link_url,$link_img,$title,$link_rel);
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link_url'] = strip_tags( $new_instance['link_url'] );
		$instance['link_rel'] = strip_tags( $new_instance['link_rel'] );
		$instance['link_class'] = strip_tags( $new_instance['link_class'] );
		$instance['link_img'] = strip_tags( $new_instance['link_img'] );
		return $instance;
	}
	
	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Default Title', 'cs_bar'), 'link_url' => __('http://www.google.com', 'cs_bar'), 'link_rel' => __('fancybox fancybox.iframe', 'cs_bar'),'link_img' => __('http://172.16.33.175/elgi-sauer/wp-content/uploads/2012/01/product_finder.png', 'cs_bar') );
		$instance = wp_parse_args( (array) $instance, $defaults ); 
		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
		</p>

		<!-- Link URL: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link_url' ); ?>"><?php _e('Link URL:', 'cs_bar'); ?></label>
			<input id="<?php echo $this->get_field_id( 'link_url' ); ?>" name="<?php echo $this->get_field_name( 'link_url' ); ?>" value="<?php echo $instance['link_url']; ?>" style="width:100%;" />
		</p>
		
		<!-- Link Relation: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link_rel' ); ?>"><?php _e('Link Relation :', 'cs_bar'); ?></label>
			<input id="<?php echo $this->get_field_id( 'link_rel' ); ?>" name="<?php echo $this->get_field_name( 'link_rel' ); ?>" value="<?php echo $instance['link_rel']; ?>" style="width:100%;" />
		</p>	
		<!-- Link Class: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link_class' ); ?>"><?php _e('Link Class :', 'cs_bar'); ?></label>
			<input id="<?php echo $this->get_field_id( 'link_class' ); ?>" name="<?php echo $this->get_field_name( 'link_class' ); ?>" value="<?php echo $instance['link_class']; ?>" style="width:100%;" />
		</p>
		<!-- Link Image: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'link_img' ); ?>"><?php _e('Link Image:', 'cs_bar'); ?></label>
			<input id="<?php echo $this->get_field_id( 'link_img' ); ?>" name="<?php echo $this->get_field_name( 'link_img' ); ?>" value="<?php echo $instance['link_img']; ?>" style="width:100%;" />
		</p>


	<?php
	}
}

?>

