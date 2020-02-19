<?php

require_once 'class-popular-posts-components.php';
require_once 'class-popular-posts-init.php';
class popularPostsWidget extends Popular_Posts_Components {
    private $options_handler;
    private $opts;

	public function __construct() {
		parent::__construct(
			'popular_posts_widget',
			__('Popular Posts Widget'),
			array( 'description' => 'Allow to show the most popular posts.' )
		);
		$this->options_handler = new Popular_Posts_Init();
		$this->opts = $this->options_handler->get_options_params();
	}

	// Front
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		$posts_per_page = $instance['amount'];

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
		foreach ( $this->opts as $id => $opt ) {
			$opt_value = isset( $instance[ $id ] ) ? $instance[ $id ] : $opt['default'];
			$opt_id = $this->get_field_id( $id );
			$opt_name = $this->get_field_name( $id );
			$opt_title = $opt['title'];
			$opt_type = $opt['type'];
			switch ( $opt_type ) {
				case 'text':
					echo $this->input_text($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'number':
					echo $this->input_number($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'checkbox':
					echo $this->input_checkbox($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'select':
					echo $this->input_select($opt_id, $opt_name, $opt_value, $opt_title, $opt['choices']);
					break;
			}
		}
	}

	// Save
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->opts as $id => $opt ) {
			$opt_type = $opt['type'];
			switch ( $opt_type ) {
                case 'text':
	                $instance[$id] = ( ! empty( $new_instance[$id] ) ) ? strip_tags( $new_instance[$id] ) : '';
	                break;
                case 'number' :
	                $instance[$id] = ( is_numeric( $new_instance[$id] ) ) ? $new_instance[$id] : '0';
	                break;
                case 'checkbox':
	                $instance[$id] = ( ! empty( $new_instance[$id] ) ) ? $new_instance[$id] : '';
	                break;
                case 'select':
	                $instance[$id] =  isset($new_instance[$id]) ? $new_instance[$id] : $old_instance[$id];
            }
		}
		return $instance;
	}
}
