jQuery( document ).ready( function($) {

	/* === Sortable Multi-CheckBoxes === */

	/* Make it sortable. */
	$( 'ul.regur_hpp_multicheck_sortable_list' ).sortable({
		handle: '.regur_hpp_multicheck_sortable_handle',
		axis: 'y',
		update: function( e, ui ){
			$('input.regur_hpp_multicheck_sortable_item').trigger( 'change' );
		}
	});

	/* On changing the value. */
	$( "input.regur_hpp_multicheck_sortable_item" ).on( 'change', function() {

		/* Get the value, and convert to string. */
		this_checkboxes_values = $( this ).parents( 'ul.regur_hpp_multicheck_sortable_list' ).find( 'input.regur_hpp_multicheck_sortable_item' ).map( function() {
			var active = '0';
			if( $(this).prop("checked") ){
				var active = '1';
			}
			return this.name + ':' + active;
		}).get().join( ',' );

		/* Add the value to hidden input. */
		$( this ).parents( 'ul.regur_hpp_multicheck_sortable_list' ).find( 'input.regur_hpp_multicheck_sortable' ).val( this_checkboxes_values ).trigger( 'change' );

	});

	/* === Multi-CheckBoxes === */

	/* On changing the value. */
	$( "input.regur_hpp-multicheck-item" ).on( 'change', function() {

		/* Get the value (only the "checked" item), and convert to comma separated string. */
		this_checkboxes_values = $( this ).parents( 'ul.regur_hpp-multicheck-list' ).find( 'input.regur_hpp-multicheck-item:checked' ).map( function() {
			return this.name;
		}).get().join( ',' );

		/* Add the value to hidden input. */
		$( this ).parents( 'ul.regur_hpp-multicheck-list' ).find( 'input.regur_hpp-multicheck' ).val( this_checkboxes_values ).trigger( 'change' );

	});
});
