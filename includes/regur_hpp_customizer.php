<?php


/*Customizer setting*/
function regur_hpp_customizer($wp_customize){

$wp_customize->add_panel('some_panel',array(
    'title'=>'Panel1',
    'description'=> 'This is panel Description',
    'priority'=> 10,
));
/*----------------------------------------*/
$wp_customize->add_section('section',array(
    'title'=>'Home page bolg settings',
    'priority'=>10,
    //'panel'=>'some_panel',
));
/*----------------------------------------*/
$wp_customize->add_setting("regur_hpp_plugin_enable",array(
    'default'=>'a',
    'type' => 'option'
));


$wp_customize->add_control("regur_hpp_plugin_enable",array(
    'label'=>'Enable|Disable Plugin',
    'type'=>'checkbox',
    'section'=>'section',
    'setting'=>"regur_hpp_plugin_enable",
));
/*----------------------------------------*/
$wp_customize->add_setting("regur_hpp_title",array(
    'default'=>'a',
    'type' => 'option'
));


$wp_customize->add_control("regur_hpp_title",array(
    'label'=>'Title',
    'type'=>'text',
    'section'=>'section',
    'setting'=>"regur_hpp_title",
));
/*----------------------------------------*/
$wp_customize->add_setting("regur_hpp_no_of_post",array(
    'default'=>'a',
    'type' => 'option'
));
$wp_customize->add_control("regur_hpp_no_of_post",array(
    'label'=>'Dsiaply no. of post',
    'section'=>'section',
    'setting'=>"regur_hpp_no_of_post",
    'type'   => 'select',
    'choices'=> array(
        '1' => __( '1' ),
        '2'=> __( '2' ),
        '3'=> __( '3' ),
        '4'=> __( '4' ),
        '5'=> __( '5' ),
        '6'=> __( '6' )
        )
));
/*----------------------------------------*/
$wp_customize->add_setting("regur_hpp_multiple_row",array(
    'default'=>'a',
    'type' => 'option',
));


$wp_customize->add_control("regur_hpp_multiple_row",array(
    'label'=>'Multiple rows',
    'type'=>'checkbox',
    'section'=>'section',
    'setting'=>"regur_hpp_multiple_row",
));
/*----------------------------------------*/
	$wp_customize->add_setting("regur_hpp_no_of_post_row",array(
    'default'=>'a',
    'type' => 'option'
));
$wp_customize->add_control("regur_hpp_no_of_post_row",array(
    'label'=>'No. of post in row',
    'section'=>'section',
    'setting'=>"regur_hpp_no_of_post_row",
    'type'   => 'select',
    'choices'=> array(
        '1' => __( '1' ),
        '2'=> __( '2' ),
        '3'=> __( '3' )
        )
));

/*----------------------------------------*/
$wp_customize->add_setting("regur_hpp_post_css",array(
    'default'=>'a',
    'type' => 'option'
));


$wp_customize->add_control("regur_hpp_post_css",array(
    'label'=>'Add custom CSS',
    'type'=>'textarea',
    'section'=>'section',
    'setting'=>"regur_hpp_post_css",
));

}  
 add_action('customize_register','regur_hpp_customizer');
/*Ends*/

function custom_customize_enqueue()
{
?>
		<script>
		document.addEventListener('DOMContentLoaded', () => 
		{
			jQuery(document).ready(function($)
			{
				jQuery('#_customize-input-regur_hpp_multiple_row').change(function()
				{
					regur_multirow_check();
				});

				jQuery('#customize-control-regur_hpp_no_of_post_row').hide();
				function regur_multirow_check() 
				{
					var regur_hpp_multiple_row = jQuery('#_customize-input-regur_hpp_multiple_row').prop('checked');
						if (regur_hpp_multiple_row) {
							jQuery('#customize-control-regur_hpp_no_of_post_row').show();
						}
						else
						{
							jQuery('#customize-control-regur_hpp_no_of_post_row').hide();
						}

				}regur_multirow_check();


				jQuery( "#sortable" ).sortable({

  		placeholder: "ui-state-highlight",
  		update: function (event, ui) {
             var post_seq = [];
       		jQuery('.regur_hpp_post_sequence').each( function() 
       		{
       			temp=jQuery(this).val();
				post_seq.push(temp);
			});
			jQuery('#regur_hpp_post_sequence').val(post_seq);
            }
	});

	jQuery( "#sortable" ).disableSelection();



			});
		});

		</script>
<?php
/* CSS */
    wp_register_style( 'regur_hpp-customize',plugins_url().'/regur-hpp/css/regur_customizer_control.css' );

    /* JS */
    wp_register_script( 'regur_hpp-customize',plugins_url().'/regur-hpp/js/regur_customizer_control.js', array( 'jquery', 'jquery-ui-sortable', 'customize-controls' ) );
}
add_action( 'customize_controls_enqueue_scripts', 'custom_customize_enqueue' );
