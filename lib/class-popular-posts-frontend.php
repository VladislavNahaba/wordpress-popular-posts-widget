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

	private function get_arguments() {
		return array(
			'post_type' => $this->instance['entity_type'],
			'posts_per_page' => $this->instance['amount'],
			'orderby' => $this->instance['sort'],
			'order' => $this->instance['sort_order'],
			'post__not_in' => isset($this->instance['exclude_post']) ? $this->instance['exclude_post'] : array(),
			'cat' => isset($this->instance['include_categories']) ? $this->instance['include_categories'] : array(),
			'category__not_in' => isset($this->instance['exclude_categories']) ? $this->instance['exclude_categories'] : array(),
			'tag__not_in' => isset($this->instance['include_tags']) ? $this->instance['include_tags'] : array(),
			'author__in' => isset($this->instance['include_authors']) ? $this->instance['include_authors'] : array(),
		);
	}

	public function get_template_data() {
		$query_obj = new WP_Query();
		$query = $query_obj->query($this->get_arguments());
		$result = [];
		$thumbnail_size = isset($this->instance['thumbnail']) ? $this->instance['thumbnail'] : 'thumbnail';
		foreach ($query as $post) {
			array_push($result, array(
				'link' => get_permalink($post),
				'title' => get_the_title($post),
				'image_link' => (has_post_thumbnail($post->ID) ? get_the_post_thumbnail_url($post->ID, $thumbnail_size) : ''),
				'description' => $this->get_configurable_excerpt(
					$post,
					array(
						'maxchar' => $this->instance['description_length'],
						'ignore_more' => true
					)
				),
				'comments_number' => get_comments_number($post),
				'comments_link' => get_comments_link($post),
				'date_w3c' => esc_attr(get_the_date(DATE_W3C, $post)),
				'date' => esc_html(get_the_date('', $post))
			));
		}
		return $result;
	}

	private function get_configurable_excerpt($post,  $args = '' ) {
		if( is_string($args) ) {
			parse_str( $args, $args );
		}
		$rg = (object) array_merge( array(
			'maxchar'     => 350,
			'text'        => '',
			'autop'       => true,
			'save_tags'   => '',
			'more_text'   => 'read more...',
			'ignore_more' => false,
		), $args );
		if( ! $rg->text ) {
			$rg->text = $post->post_excerpt ?: $post->post_content;
		}
		$text = $rg->text;
		$text = preg_replace( '~\[([a-z0-9_-]+)[^\]]*\](?!\().*?\[/\1\]~is', '', $text );
		$text = preg_replace( '~\[/?[^\]]*\](?!\()~', '', $text );
		$text = trim( $text );
		if( ! $rg->ignore_more  &&  strpos( $text, '<!--more-->') ) {
			preg_match('/(.*)<!--more-->/s', $text, $mm );
			$text = trim( $mm[1] );
			$text_append = ' <a href="'. get_permalink( $post ) .'#more-'. $post->ID .'">'. $rg->more_text .'</a>';
		} else {
			$text = trim( strip_tags($text, $rg->save_tags) );
			if( mb_strlen($text) > $rg->maxchar ){
				$text = mb_substr( $text, 0, $rg->maxchar );
				$text = preg_replace( '~(.*)\s[^\s]*$~s', '\\1...', $text );
			}
		}
		if( $rg->autop ) {
			$text = preg_replace(
				array("/\r/", "/\n{2,}/", "/\n/",   '~</p><br ?/?>~'),
				array('',     '</p><p>',  '<br />', '</p>'),
				$text
			);
		}
		if( isset($text_append) ) {
			$text .= $text_append;
		}
		return ( $rg->autop && $text ) ? "$text" : $text;
	}
}
