<?php

require_once 'class-popular-posts-components.php';
require_once 'class-popular-posts-init.php';
class popularPostsWidget extends Popular_Posts_Components {

	public function __construct() {
		parent::__construct(
			'popular_posts_widget',
			__('Popular Posts Widget'),
			array( 'description' => 'Allow to show the most popular posts.' )
		);
	}

	// Front
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$posts_per_page = $instance['posts_per_page'];

		echo $args['before_widget'];

		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];

		$q = new WP_Query("posts_per_page=$posts_per_page&orderby=comment_count");
		if( $q->have_posts() ):
			?><ul><?php
			while( $q->have_posts() ): $q->the_post();
				?><li><a href="<?php the_permalink() ?>"><?php the_title() ?></a></li><?php
			endwhile;
			?></ul><?php
		endif;
		wp_reset_postdata();

		echo $args['after_widget'];
	}

	// Back
	public function form( $instance ) {
		$init = new Popular_Posts_Init();
		$opts = $init->get_options_params();
		foreach ( $opts as $id => $opt ) {
			$opt_value = isset( $instance[ $id ] ) ? $instance[ $id ] : $opt['default'];
			$opt_id = $this->get_field_id( $id );
			$opt_name = $this->get_field_name( $id );
			$opt_title = $opt['title'];
			$opt_type = $opt['type'];
			switch ( $opt_type ) {
				case 'text':
					echo $this->start_paragraph();
					echo $this->input_text($opt_id, $opt_name, $opt_value, $opt_title);
					echo $this->end_paragraph();
					break;
				case 'number':
					echo $this->start_paragraph();
					echo $this->input_number($opt_id, $opt_name, $opt_value, $opt_title);
					echo $this->end_paragraph();
					break;
				case 'checkbox':
					echo $this->start_paragraph();
					echo $this->input_checkbox($opt_id, $opt_name, $opt_value, $opt_title);
					echo $this->end_paragraph();
					break;
				case 'select':
					echo $this->start_paragraph();
					echo $this->input_select($opt_id, $opt_name, $opt_value, $opt_title, $opt['choices']);
					echo $this->end_paragraph();
					break;
			}
		}
	}

	private function start_paragraph() {
		return '<p>';
	}
	private function end_paragraph() {
		return '</p>';
	}

	// Save
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['posts_per_page'] = ( is_numeric( $new_instance['posts_per_page'] ) ) ? $new_instance['posts_per_page'] : '5'; // по умолчанию выводятся 5 постов
		return $instance;
	}
}
