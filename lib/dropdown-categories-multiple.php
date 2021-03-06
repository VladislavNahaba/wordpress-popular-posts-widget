<?php
if( is_admin() ) {
	add_filter( 'wp_dropdown_cats', 'wp_dropdown_cats_multiple', 10, 2 );
	function wp_dropdown_cats_multiple( $output, $r ) {
		if ( isset( $r['multiple'] ) && $r['multiple'] ) {
			$output = preg_replace( '/^<select/i', '<select multiple', $output );
			$output = preg_replace( '/name=([\'"]{1})(.*?)\1/i', 'name=$2[]', $output );
			foreach ( array_map( 'trim', explode( ",", $r['selected'] ) ) as $value ) {
				$output = str_replace( "value=\"{$value}\"", "value=\"{$value}\" selected", $output );
			}
		}
		return $output;
	}
}
