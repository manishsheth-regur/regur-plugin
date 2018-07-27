<?php

function regur_hpp_sequences(){

	$sequences = array();

	/* Title */
	$sequences['Title'] = array(
		'id'       => 'Title',
		'label'    => __( 'Title', 'regur_hpp' ),
	);

	/* Image */
	$sequences['Image'] = array(
		'id'       => 'Image',
		'label'    => __( 'Image', 'regur_hpp' ),
	);

	/* Content */
	$sequences['Content'] = array(
		'id'       => 'Content',
		'label'    => __( 'Content', 'regur_hpp' ),
	);

	return apply_filters( 'regur_hpp_sequences', $sequences );
}


function regur_hpp_sequences_default(){
	$default = array();
	$sequences = regur_hpp_sequences();
	foreach( $sequences as $service ){
		$default[] = $service['id'] . ':1'; /* activate all as default. */
	}
	return apply_filters( 'regur_hpp_sequences_default', implode( ',', $default ) );
}


add_action( 'customize_register', 'regur_hpp_customizer_register' );

/**
 * Customize Register
 */
function regur_hpp_customizer_register( $wp_customize ){

	/* Load custom controls */
	require dirname(__FILE__).'/regur_hpp_sortable_customizer_controls.php';
	// require dirname(__FILE__).'/regur_hpp_post_shortcode.php';


	/* Add Section */
	$wp_customize->add_section(
		'regur_hpp',
		array(
			'title' => esc_html__( 'section'),
		)
	);

	/* === sequences === */

	/* Add Settings */
	$wp_customize->add_setting(
		'regur_hpp_post_sequence', /* option name */
		array(
			'default'           => regur_hpp_sequences_default(),
			'sanitize_callback' => 'regur_hpp_sanitize_sequences',
			'transport'         => 'refresh',
			'type'              => 'option',
			'capability'        => 'manage_options',
		)
	);

	/* Add Control for the settings. */
	$choices = array();
	$sequences = regur_hpp_sequences();
	foreach( $sequences as $key => $val ){
		$choices[$key] = $val['label'];
	}
	$wp_customize->add_control(
		new regur_hpp_customize_control_cortable_checkboxes(
			$wp_customize,
			'regur_hpp_post_sequence', /* control id */
			array(
				'section'     => 'section',
				'settings'    => 'regur_hpp_post_sequence',
				'label'       => __( 'Post Sequence' ),
				'description' => __( 'Change Sequence or Enable/Disable sequence os post ' ),
				'choices'     => $choices,
			)
		)
	);


} // end customize register


function regur_hpp_sanitize_sequences( $input ){

	/* Var */
	$output = array();

	/* Get valid sequences */
	$valid_sequences = regur_hpp_sequences();

	/* Make array */
	$sequences = explode( ',', $input );
		//die();
	/* Bail. */
	if( ! $sequences ){
		return null;
	}

	/* Loop and verify */
	foreach( $sequences as $service ){

		/* Separate service and status */
		$service = explode( ':', $service );

		if( isset( $service[0] ) && isset( $service[1] ) ){
			if( array_key_exists( $service[0], $valid_sequences ) ){
				$status = $service[1] ? '1' : '0';
				$output[] = trim( $service[0] . ':' . $status );
			}
		}

	}

	return trim( esc_attr( implode( ',', $output ) ) );
}
