<?php
/*Meta box for post page Start*/
function regur_hpp_show_post_on_home( $post_type, $post ) 
{
    add_meta_box( 
        'Show post at home page',
        __( 'Show post at home page' ),
        'regur_hpp_show_post_on_home_controls',
        'post',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes_post', 'regur_hpp_show_post_on_home', 10, 2 );

function regur_hpp_show_post_on_home_controls($post)
{
		wp_nonce_field( 'regur_hpp_control_meta_box', 'regur_hpp_control_meta_box_nonce' ); 
		// Always add nonce to your meta boxes!
		$regur_hpp_show_at_home=get_post_meta($post->ID , 'regur_hpp_show_at_home', true );
	?>
		<style type="text/css">
			.post_meta_extras p{margin: 20px;}
			.post_meta_extras label{display:block; margin-bottom: 10px;}
		</style>

		<label><input type="checkbox" name="regur_hpp_show_at_home" value="y" <?php if(get_post_meta($post->ID,'regur_hpp_show_at_home', true ) == "y" ){echo ' checked="checked"';} ?> /><?php esc_attr_e( 'Show on home Page' ); ?></label></p>
	<?php
}
	
/*For Saving th value of checkbox in database */
function regur_hpp_save_metaboxes_checkbox( $post_id ) 
{
	update_post_meta( $post_id, 'regur_hpp_show_at_home', $_POST['regur_hpp_show_at_home'] );
}
add_action( 'save_post', 'regur_hpp_save_metaboxes_checkbox' );
/*Meta Box Ends HERE*/
