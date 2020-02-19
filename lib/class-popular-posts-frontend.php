<?php
class Popular_Posts_Frontend {
	private $instance;

	public function __construct($instance) {
		$this->instance = $instance;
	}
	//TODO: exclude/include categories, authors, tags
	public function get_arguments() {
		return array(
			'posts_per_page' => $this->instance['amount'],
			'orderby' => $this->instance['sort'],
			'order' => $this->instance['sort_order'],

		);
	}
}
