<?php
class regur_hpp_customize_control_cortable_checkboxes extends WP_Customize_Control {

	/**
	 * Control Type
	 */
	public $type = 'regur_hpp_multicheck_sortable';

	/**
	 * Enqueue 
	 */
	public function enqueue() {
		wp_enqueue_style( 'regur_hpp-customize' );
		wp_enqueue_script( 'regur_hpp-customize' );
	}

	/**
	 * Render Settings
	 */
	public function render_content() {

		/* if no choices, bail. */
		if ( empty( $this->choices ) ){
			return;
		} ?>
		
		<?php if ( !empty( $this->label ) ){ ?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
		<?php } // add label if needed. ?>

		<?php if ( !empty( $this->description ) ){ ?>
			<span class="description customize-control-description"><?php echo $this->description; ?></span>
		<?php } // add desc if needed. ?>

		<?php
		/* Data */
		$values = explode( ',', $this->value() );
		$choices = $this->choices;

		/* If values exist, use it. */
		$options = array();
		if( $values ){

			/* get individual item */
			foreach( $values as $value ){

				/* separate item with option */
				$value = explode( ':', $value );

				/* build the array. remove options not listed on choices. */
				if ( array_key_exists( $value[0], $choices ) ){
					$options[$value[0]] = $value[1] ? '1' : '0'; 
				}
			}
		}
		/* if there's new options (not saved yet), add it in the end. */
		foreach( $choices as $key => $val ){

			/* if not exist, add it in the end. */
			if ( ! array_key_exists( $key, $options ) ){
				$options[$key] = '0'; // use zero to deactivate as default for new items.
			}
		}
		?>

		<ul class="regur_hpp_multicheck_sortable_list">

			<?php foreach ( $options as $key => $value ){ ?>

				<li>
					<label>
						<input name="<?php echo esc_attr( $key ); ?>" class="regur_hpp_multicheck_sortable_item" type="checkbox" value="<?php echo esc_attr( $value ); ?>" <?php checked( $value ); ?> /> 
						<?php echo esc_html( $choices[$key] ); ?>
					</label>
					<i class="dashicons dashicons-menu regur_hpp_multicheck_sortable_handle"></i>
				</li>

			<?php } // end choices. ?>

				<li class="regur_hpp_hideme">
					<input type="hidden" class="regur_hpp_multicheck_sortable" <?php $this->link(); ?> value="<?php echo esc_attr( $this->value() ); ?>" />
				</li>

		</ul><!-- .regur_hpp_multicheck_sortable_list -->


	<?php
	}
}
