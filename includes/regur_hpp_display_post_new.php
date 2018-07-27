<?php
	if (!empty(get_option( 'regur_hpp_plugin_enable' ))) {
		if(!empty(get_option( 'regur_hpp_no_of_post' ))){ $regur_hpp_total_post = get_option( 'regur_hpp_no_of_post' );}
		$regur_hpp_post_sequence = get_option( 'regur_hpp_post_sequence' );
	if (!empty($regur_hpp_post_sequence))
	$regur_hpp_post_sequence = explode(',', $regur_hpp_post_sequence);
		?>
		<div class="wrap">
				<?php if (!empty($post_title = get_option( 'regur_hpp_title' ))) { echo "<div class='regur_hpp_title'>$post_title</div>";} ?>
				<div id="regur_hpp_widget">
				<?php
					
				 $the_query = new WP_Query( array(
       'post_type'      => 'post',
       'posts_per_page' => -1,
    ));

    // The Loop
    $temp_row=1;
    while ( $the_query->have_posts() ) : $the_query->the_post(); 
    	$ID=get_the_ID();
    $checked_meta = get_post_meta( $ID, 'regur_hpp_show_at_home', true );
    ?>

    <?php if( $checked_meta == 'y' && $temp_row<=$regur_hpp_total_post) {

	?>

	<div class="regur_hpp_coloum_default  style="">

		<?php
			if (!empty($regur_hpp_post_sequence)) {
				 foreach ($regur_hpp_post_sequence as $value) {
				$values = explode(':', $value); 
		if($values[0] == 'Title' && $values[1])
			{

			 ?>
			<div><h4 class="regur_hpp_post_title"><a href="<?php the_permalink();?>"><?php the_title(); ?></a></h4></div>
			<?php }  

		if($values[0] == 'Image' && $values[1])
			{ ?>

	 			<div class="regur_hpp_post_image"><a href="<?php the_permalink();?>"><?php the_post_thumbnail('medium'); ?></a></div>
	 			<?php
	 		}
	 		if($values[0] == 'Content' && $values[1])
 			{
	 			?><div class="regur_hpp_post_content" ><?= the_excerpt() ?></div>
	 			<?php
	 		}
	 	}
	 }
	 			?>
	 			
	</div>

   <?php
    $temp_row++;
    }
    ?>

   <?php 

   endwhile;
   // Reset Post Data
   wp_reset_postdata();

   ?>
   </div>
			</div>
		<?php
	}
?>
