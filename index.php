<?php
/*
Plugin Name: Home Page Posts WordPress Plugin
Plugin Description: Easily display selected posts on your website home page with this plugin. Easily customize the display of the posts on your home page.
Plugin Author: Regur Technolgoy Solutions
Author URL: http://www.regur.net/
*/


require dirname(__FILE__).'/includes/regur_hpp_post_metabox.php';
require dirname(__FILE__).'/includes/regur_hpp_customizer.php';
require dirname(__FILE__).'/includes/regur_hpp_setting_page.php';
require dirname(__FILE__).'/includes/regur_hpp_post_shortcode.php';
require dirname(__FILE__).'/includes/regur_hpp_widget.php';
require dirname(__FILE__).'/includes/regur_hpp_sortable_customizer.php';

/*Including style sheet in wp head section*/
add_action('wp_head', 'regur_hpp_home_style');
function regur_hpp_home_style()
{
	if (is_home()) {
		require  dirname(__FILE__).'/css/regur_hpp_home_style.php';
	}
}

add_action('admin_enqueue_scripts', 'regur_hpp_admin_scripts');
function regur_hpp_admin_scripts()
{
	 wp_register_style( 'rhpbp_jquery_ui_css', plugins_url().'/regur-hpp/css/regur_hpp_jqury_ui.css' );
    wp_enqueue_style( 'rhpbp_jquery_ui_css' );

    wp_register_style( 'rhpbp_style_css', plugins_url().'/regur-hpp/css/regur_hpp_style.css' );
    wp_enqueue_style( 'rhpbp_style_css' );

    wp_register_script( 'rhpbp_jquery_ui_js', plugins_url().'/regur-hpp/js/regur_hpp_jqury_ui.js', array(), '', true );
    wp_enqueue_script( 'rhpbp_jquery_ui_js');
}





/*User csss*/
add_action('wp_head', 'regur_hpp_custom_css');
function regur_hpp_custom_css()
{
	if (is_home()) {
		$regur_hpp_post_css = get_option( 'regur_hpp_post_css' );
		if (!empty($regur_hpp_post_css)) {
		if (isset($regur_hpp_post_css)) {
			echo "<style>".$regur_hpp_post_css."</style>\n";
		}
	}
	}
}


/*Sidebar*/
if ( function_exists('register_sidebar') ) {
register_sidebar(array(
'name' => __( 'Main Sidebar'),
'id' => 'regur_hpp_widget_sidebar',
'before_widget' => '<li id="%1$s" class="widget %2$s">',
'after_widget' => '</li>',
'before_title' => '<h2 class="widgettitle">',
'after_title' => '</h2>',
));
}



