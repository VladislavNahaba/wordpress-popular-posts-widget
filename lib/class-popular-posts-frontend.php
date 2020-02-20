<?php
class Popular_Posts_Frontend {
	private $instance;

	public function __construct($instance) {
		$this->instance = $instance;
	}

	public function get_title() {
		$title = apply_filters( 'widget_title', $this->instance['title'] );
		if ( ! empty( $title ) && strlen($title) > $this->instance['title_max_length'] ) {
			$title = mb_substr($title, 0, $this->instance['title_max_length']);
		}
		return $title;
	}
	
	public function get_arguments() {
		return array(
			'post_type' => $this->instance['entity_type'],
			'posts_per_page' => $this->instance['amount'],
			'orderby' => $this->instance['sort'],
			'order' => $this->instance['sort_order'],
			'cat' => isset($this->instance['include_categories']) ? $this->instance['include_categories'] : array(),
			'category__not_in' => isset($this->instance['exclude_categories']) ? $this->instance['exclude_categories'] : array(),
			'tag__not_in' => isset($this->instance['include_tags']) ? $this->instance['include_tags'] : array(),
			'author__in' => isset($this->instance['include_authors']) ? $this->instance['include_authors'] : array(),
		);
	}
}
