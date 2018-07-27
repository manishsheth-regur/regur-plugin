<?php
function regur_hpp_shortcode()
{  
	require  dirname(__FILE__).'/regur_hpp_display_post_new.php';
}
add_shortcode( 'regur_hpp_shortcode', 'regur_hpp_shortcode' );

function regur_hpp_footer()
{
	if(is_home()) {
		$regur_hpp_show_above_footer=get_option( 'regur_hpp_show_above_footer');
		if (!empty($regur_hpp_show_above_footer)) {

			echo do_shortcode('[regur_hpp_shortcode]' );
		}
	}
}
add_action( 'get_footer', 'regur_hpp_footer');
