<?php

require_once 'class-popular-posts-components.php';
require_once 'class-popular-posts-init.php';
require_once 'class-popular-posts-frontend.php';

class Popular_Post_Widget extends Popular_Posts_Components {
    private $opts;

	public function __construct() {
		parent::__construct(
			'popular_posts_widget',
			__('Popular Posts Widget'),
			array('description' => 'Allow to show the most popular posts.')
		);
		$init = new Popular_Posts_Init();
		$this->opts = $init->get_options_params();
	}

	public function widget($args, $instance) {
//	    $frontend_handler = new Popular_Posts_Frontend($instance);
		$title = apply_filters('widget_title', $instance['title']);
		echo $args['before_widget'];
		if (!empty($title)) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		$template = $this->get_template_data($instance);
//		$template_data = $frontend_handler->get_template_data();
		ob_start();
        require POPULAR_DIR . 'templates/' . $instance['template'];
		$form = ob_get_contents();
		ob_end_clean();
        echo $form;
		wp_reset_postdata();
		echo $args['after_widget'];
	}

	public function form($instance) {
		echo '<div class="widget-popular-posts">';
		foreach ( $this->opts as $id => $opt ) {
			$opt_value = isset($instance[ $id ]) ? $instance[ $id ] : $opt['default'];
			$opt_id = $this->get_field_id($id);
			$opt_name = $this->get_field_name($id);
			$opt_title = $opt['title'];
			$opt_type = $opt['type'];
			switch ( $opt_type ) {
				case 'text':
					$this->input_text($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'number':
					$this->input_number($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'checkbox':
					$this->input_checkbox($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'select':
					echo $this->input_select($opt_id, $opt_name, $opt_value, $opt_title, $opt['choices']);
					break;
				case 'category':
					$this->input_category($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'tag':
					$this->input_tag($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'author':
					$this->input_author($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'post':
					$this->input_post($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'template':
					$this->input_template($opt_id, $opt_name, $opt_value, $opt_title);
					break;
				case 'thumbnail':
					$this->input_thumbnail($opt_id, $opt_name, $opt_value, $opt_title);
					break;
			}
		}
		echo '</div>';
	}

	public function update($new_instance, $old_instance) {
		$instance = array();
		foreach ($this->opts as $id => $opt) {
			$opt_type = $opt['type'];
			switch ($opt_type) {
                case 'text':
	                $instance[$id] = (!empty( $new_instance[$id])) ? strip_tags($new_instance[$id]) : '';
	                break;
                case 'number' :
	                $instance[$id] = is_numeric( $new_instance[$id]) ? $new_instance[$id] : '0';
	                break;
                case 'checkbox':
	                $instance[$id] = (!empty( $new_instance[$id])) ? $new_instance[$id] : '';
	                break;
                case 'select':
				case 'template':
				case 'thumbnail':
	                $instance[$id] =  isset($new_instance[$id]) ? $new_instance[$id] : $old_instance[$id];
	                break;
				case 'tag':
				case 'category':
				case 'author':
				case 'post':
					$instance[$id] =  $new_instance[$id];
					break;
            }
		}
		return $instance;
	}

	private function get_template_data($instance) {
		$query_obj = new WP_Query();
		return $query_obj->query($this->get_query_arguments($instance));
	}

	private function get_query_arguments($instance) {
		return array(
			'post_type' => $instance['entity_type'],
			'posts_per_page' => $instance['amount'],
			'orderby' => $instance['sort'],
			'order' => $instance['sort_order'],
			'post__not_in' => isset($instance['exclude_post']) ? $instance['exclude_post'] : array(),
			'cat' => isset($instance['include_categories']) ? $instance['include_categories'] : array(),
			'category__not_in' => isset($instance['exclude_categories']) ? $instance['exclude_categories'] : array(),
			'tag__not_in' => isset($instance['include_tags']) ? $instance['include_tags'] : array(),
			'author__in' => isset($instance['include_authors']) ? $instance['include_authors'] : array(),
		);
	}
}
