<?php
/*this is new setting menu by using Setting api*/

add_action( 'admin_menu', 'regur_hpp_post_menu' );
function regur_hpp_post_menu() {
    add_options_page( 'Show post at home', 'Show post at home', 'manage_options', 'regur_hpp', 'regur_hpp_callback' );
}

add_action( 'admin_init', 'my_admin_init' );
function my_admin_init() 
{
	add_settings_section( 'section-one', '', 'section_one_callback', 'regur_hpp' );

    register_setting( 'regur_hpp_settings', 'regur_hpp_plugin_enable' );
    add_settings_field( 'regur_hpp_plugin_enable', 'Enable', 'regur_hpp_plugin_enable_callback', 'regur_hpp', 'section-one' );

    register_setting( 'regur_hpp_settings', 'regur_hpp_title' );
    add_settings_field( 'regur_hpp_title', 'Title', 'regur_hpp_title_callback', 'regur_hpp', 'section-one' );

    register_setting( 'regur_hpp_settings', 'regur_hpp_post_sequence' );
    add_settings_field( 'regur_hpp_sequence', 'Post Sequence', 'regur_hpp_sequence_callback', 'regur_hpp', 'section-one' );
    register_setting( 'regur_hpp_settings', 'regur_hpp_no_of_post' );
    add_settings_field( 'regur_hpp_no_of_post', 'Display no. of post', 'regur_hpp_no_of_post_callback', 'regur_hpp', 'section-one' );

     register_setting( 'regur_hpp_settings', 'regur_hpp_multiple_row' );
    add_settings_field( 'regur_hpp_multiple_row', 'Multiple rows', 'regur_hpp_multiple_row_callback', 'regur_hpp', 'section-one' , array('class'=>'regur_hpp_multiple_row') );

    register_setting( 'regur_hpp_settings', 'regur_hpp_no_of_post_row' );
    add_settings_field( 'regur_hpp_no_of_post_row', 'No. of post in row', 'regur_hpp_no_of_post_row_callback', 'regur_hpp', 'section-one' , array('class'=>'regur_hpp_no_of_post_row') );

    register_setting( 'regur_hpp_settings', 'regur_hpp_show_above_footer' );
    add_settings_field( 'regur_hpp_show_above_footer', 'Display above footer', 'regur_hpp_show_above_footer_callback', 'regur_hpp', 'section-one' );

    register_setting( 'regur_hpp_settings', 'regur_hpp_post_css' );
    add_settings_field( 'regur_hpp_post_css', 'Add custom css', 'regur_hpp_post_css_callback', 'regur_hpp', 'section-one' );
}

function section_one_callback() 
{
    // echo 'Some help text goes here.';
}

function regur_hpp_plugin_enable_callback() 
{
    $regur_hpp_plugin_enable = esc_attr( get_option( 'regur_hpp_plugin_enable' ) );
?>
    <input type='checkbox' name='regur_hpp_plugin_enable' value='enable' <?php if (!empty($regur_hpp_plugin_enable)) {echo "checked";}?>/>
    <p class="description">This Checkbox must be enable to show post at home page</p>
    
<?php
}

function regur_hpp_title_callback() {
     $regur_hpp_title = esc_attr( get_option( 'regur_hpp_title' ) );
    echo "<input type='text' name='regur_hpp_title' value='$regur_hpp_title' /> <p class='description'>This title will be display at page</p>";
}

function regur_hpp_sequence_callback()
{
	//$values = array();
	//$regur_hpp_sequence = get_option( 'regur_hpp_sequence' );
	$regur_hpp_post_sequence = get_option( 'regur_hpp_post_sequence' );
	if (!empty($regur_hpp_post_sequence))
	$regur_hpp_post_sequence = explode(',', $regur_hpp_post_sequence);
	
?>
	<div class="regur_hpp_widget">
			<!-- Widget Title -->
			<div id="regur_hpp_widget_title"> 
				<h2> Display Wigets</h2></div> 
	<div id="sortable">
		<?php
			if (!empty($regur_hpp_post_sequence)) {
				 foreach ($regur_hpp_post_sequence as $value) {
				$values = explode(':', $value); 
		if($values[0] == 'Title')
			{

			 ?>
				<div class="sortable_widget ui-state-default">
					<span class="regur_hpp_checkbox">
					<input type="checkbox" class="regur_hpp_post_sequence" name="regur_hpp_sequence[]" value="Title"; <?php checked( $values[1]) ?>>
					</span>
					<label><b>Title</b></label>
					<span class=" regur_hpp_icons ui-icon ui-icon-arrowthick-2-n-s"></span>
				</div>

		<?php }  

		if($values[0] == 'Image')
			{ ?>
 		<div class="sortable_widget ui-state-default">
 			<span class="regur_hpp_checkbox">
 			<input type="checkbox" class="regur_hpp_post_sequence" name="regur_hpp_sequence[]" value="Image" <?php checked( $values[1]) ?>>
 			</span>
			<label><b>Image</b></label>
  			<span class=" regur_hpp_icons ui-icon ui-icon-arrowthick-2-n-s"></span>
 		</div>

 		<?php } 

 		if($values[0] == 'Content')
 			{ ?>
 				<div class="sortable_widget ui-state-default">
 					<span class="regur_hpp_checkbox">
					<input type="checkbox" class="regur_hpp_post_sequence" name="regur_hpp_sequence[]" value="Content" <?php checked( $values[1]) ?>>
					</span>
					<label><b>Content</b></label>
  					<span class="regur_hpp_icons ui-icon ui-icon-arrowthick-2-n-s"></span>
 				</div>
		<?php 
			}

		} 
			}
			else
			{
				
			?>
			<div class="sortable_widget ui-state-default"><span class="regur_hpp_checkbox"><input type="checkbox" class="regur_hpp_post_sequence" name="regur_hpp_sequence[]" value="Title"></span><label><b>Title</b></label><span class=" regur_hpp_icons ui-icon ui-icon-arrowthick-2-n-s"></span></div>
		
	 		<div class="sortable_widget ui-state-default"><span class="regur_hpp_checkbox"><input type="checkbox" class="regur_hpp_post_sequence" name="regur_hpp_sequence[]" value="Image"></span><label><b>Image</b></label>
	  		<span class=" regur_hpp_icons ui-icon ui-icon-arrowthick-2-n-s"></span>
	 		</div>
	 		
	 		<div class="sortable_widget ui-state-default"><span class="regur_hpp_checkbox"><input type="checkbox" class="regur_hpp_post_sequence" name="regur_hpp_sequence[]" value="Content"></span><label><b>Content</b></label>
	  		<span class="regur_hpp_icons ui-icon ui-icon-arrowthick-2-n-s"></span>
	 		</div>
			<?php
			}

			?>
			<input type="hidden" name="regur_hpp_post_sequence" id="regur_hpp_post_sequence" value="<?=$regur_hpp_post_sequence?>">
			<?php
		?>
	</div>
</div>
<?php
}

function regur_hpp_post_sequence_callback()
{
	$regur_hpp_post_sequence = get_option( 'regur_hpp_post_sequence' );
	?>
	<input type="hidden" name="regur_hpp_post_sequence" id="regur_hpp_post_sequence" value="<?=$regur_hpp_post_sequence?>">
	<?php
}

function regur_hpp_no_of_post_callback()
{
	$regur_hpp_no_of_post = esc_attr( get_option( 'regur_hpp_no_of_post' ) );
	?>
	<select name="regur_hpp_no_of_post">
	 <?php for ($i=1; $i <=6 ; $i++) { 
	 	if ($i == $regur_hpp_no_of_post) 
	 	{
			echo "<option value='".$i."' selected>$i</option>";
		}
		else echo "<option value='".$i."' >$i</option>";
	 } ?>
	</select>
	<p class="description">To Dispaly no of post in Home page by default it is set to 3</p>
	<?php
}


function regur_hpp_multiple_row_callback()
{
	$regur_hpp_multiple_row = esc_attr( get_option( 'regur_hpp_multiple_row' ) );
?>
	
	<input type='checkbox' name='regur_hpp_multiple_row' value='enable' <?php if (!empty($regur_hpp_multiple_row)) {echo "checked";}?>/>
    <p class="description">To enable multiple rows in home page to display post
By default this feature is Disable</p>
<?php
}

function regur_hpp_no_of_post_row_callback()
{
	$regur_hpp_no_of_post_row = esc_attr( get_option( 'regur_hpp_no_of_post_row' ) );
	?>

	<select name="regur_hpp_no_of_post_row">
		<option value=""></option>
	 <?php for ($i=1; $i <=3 ; $i++) { 
	 	if ($i == $regur_hpp_no_of_post_row) 
	 	{
			echo "<option value='".$i."' selected>$i</option>";
		}
		else echo "<option value='".$i."' >$i</option>";
	 } ?>
	</select>
	<p class="description">Select the number of post you want to display in single row</p>
	<?php

}


function regur_hpp_show_above_footer_callback()
{
	$regur_hpp_show_above_footer =  esc_attr( get_option( 'regur_hpp_show_above_footer' ) ); 
	?>
	<input type='checkbox' name='regur_hpp_show_above_footer' value='enable' <?php if (!empty($regur_hpp_show_above_footer)) {echo "checked";}?>/>
    <p class="description">To show post just above footer of home page</p>
<?php
}

function regur_hpp_post_css_callback()
{
	$regur_hpp_post_css = esc_attr( get_option( 'regur_hpp_post_css' ) ); 
	?>
	<textarea  rows="4" cols="50" name="regur_hpp_post_css"><?php if (!empty($regur_hpp_post_css)) {
					echo $regur_hpp_post_css;
				} ?></textarea>
	<?php
}

function regur_hpp_callback() {
    ?>
    <div class="wrap">
        <h1>Post Display Setting</h1>
        <form action="options.php" method="POST">
            <?php settings_fields( 'regur_hpp_settings' ); ?>
            <?php do_settings_sections( 'regur_hpp' ); ?>
            <?php submit_button(); ?>
        </form>
    </div>
    <script>
jQuery(document).ready(function($){
	jQuery('.regur_hpp_post_sequence').change(function()
	{
		  var post_seq = [];
       		jQuery('.regur_hpp_post_sequence').each( function() 
       		{
       			seq_check = jQuery(this).prop('checked');
       			if (seq_check) {
       				temp = 1;
       			}
       			else
       			{
       				temp = 0;
       			}
       			seq=jQuery(this).val();
				post_seq.push(seq+':'+temp);

			});
			jQuery('#regur_hpp_post_sequence').val(post_seq);
		});
	/*var post_seq = [];
       		jQuery('.regur_hpp_post_sequence').each( function() 
       		{
       			temp=jQuery(this).val();
				post_seq.push(temp);
			});
			jQuery('#regur_hpp_post_sequence').val(post_seq);*/
jQuery( "#sortable" ).sortable({

  		placeholder: "ui-state-highlight",
  		update: function (event, ui) {
             var post_seq = [];
       		jQuery('.regur_hpp_post_sequence').each( function() 
       		{
       			seq_check = jQuery(this).prop('checked');
       			if (seq_check) {
       				temp = 1;
       			}
       			else
       			{
       				temp = 0;
       			}
       			seq=jQuery(this).val();
				post_seq.push(seq+':'+temp);
			});
			jQuery('#regur_hpp_post_sequence').val(post_seq);
            }
	});

	jQuery( "#sortable" ).disableSelection();


jQuery('[name="regur_hpp_multiple_row"]').change(function() {

	multi_row_check();
	});

		function multi_row_check(){
			
			jQuery('.regur_hpp_no_of_post_row').hide();
			var a= jQuery('[name="regur_hpp_multiple_row"]').prop('checked');
		if(a)
			{
				 jQuery('.regur_hpp_no_of_post_row').show();
			}
			else
			{
				jQuery('.regur_hpp_no_of_post_row').hide();
			}
		}multi_row_check();

});

</script>
    <?php
}