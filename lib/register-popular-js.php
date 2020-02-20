<?php
if (is_admin()) {
	add_action( 'admin_enqueue_scripts', function() {
		wp_enqueue_script(
			'popular_select2',
			POPULAR_URL . 'js/select2/dist/js/select2.js',
			[ 'jquery' ],
			'1',
			true
		);
		wp_enqueue_script(
			'popular_posts_script',
			POPULAR_URL . 'js/popular-widget-script.js',
			[ 'jquery' ],
			'',
			true
		);
	});
}
