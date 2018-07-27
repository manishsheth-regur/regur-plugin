<?php

// Register and load the widget
function regur_hpp_register_post_widget() {
    register_widget( 'regur_hpp_post_widget' );
}
add_action( 'widgets_init', 'regur_hpp_register_post_widget' );
 
// Creating the widget 
class regur_hpp_post_widget extends WP_Widget {
 
function __construct() {
parent::__construct(
 
// Base ID of your widget
'regur_hpp_post_widget', 
 
// Widget name will appear in UI
__('Show Post at home1', 'regur_hpp_widget_domain'), 
 
// Widget description
array( 'description' => __( 'To display post at home page', 'wpb_widget_domain' ), ) 
);
}
// Creating widget front-end
 
public function widget( $args, $instance ) {
	echo do_shortcode('[regur_hpp_shortcode]' );
}
// Widget Backend 
public function form( $instance ) {
echo "<br><a href=".admin_url( "options-general.php?page=regur_hpp_post_show_at_home_slug" ).">Go to Setting</a>";
echo "<p class='description'>To change the display setting of post click on given link</p>";
}
} // Class wpb_widget ends here

