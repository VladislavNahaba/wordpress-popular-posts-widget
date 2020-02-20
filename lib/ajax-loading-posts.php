<?php
if( is_admin() ) {
	add_action( 'wp_ajax_popular_posts_widget', function () {
		global $wpdb;
		$ajax_data = $_GET['term'];
		$res       = $wpdb->get_results( "SELECT `ID`, `post_title` FROM `{$wpdb->prefix}posts` WHERE `post_title` LIKE '{$ajax_data}%'", OBJECT );
		$result    = array(
			'results' => array()
		);
		foreach ( $res as $key => $value ) {
			array_push( $result['results'],
				[
					'id'   => $value->ID,
					'text' => $value->post_title
				]
			);
		}
		echo json_encode( $result );
		wp_die();
	} );
}
