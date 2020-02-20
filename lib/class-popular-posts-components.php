<?php
class Popular_Posts_Components extends WP_Widget {

	public function input_checkbox( $id, $name, $value, $title ) {
		$checked = ( $value == 1 ) ? ' checked="checked"' : '';
		echo $this->start_wrap() . '<label for="' . $id . '"><input type="checkbox" id="' . $id . '" value="1" name="' . $name . '" ' . $checked . ' />' . $title . '</label>' . $this->end_wrap();
	}

	public function input_text( $id, $name, $value, $title ) {
		echo $this->start_wrap() . '<label for="' . $id . '">' . $title . '<input class="widefat" type="text" id="' . $id . '" value="' . $value . '" name="' . $name . '"  /></label>' . $this->end_wrap();
	}

	public function input_number( $id, $name, $value, $title ) {
		echo $this->start_wrap() . '<label for="' . $id . '">' . $title . '<input class="widefat" type="number" step="1" max="999999" min="0" id="' . $id . '" value="' . $value . '" name="' . $name . '"  /></label>' . $this->end_wrap();
	}

	public function input_select( $id, $name, $value, $title, $options ) {
		$select = $this->start_wrap();
		$select .= '<label for="' . $id . '">' . $title . '</label>';
		$select .= '<select class="widefat popular-posts-select" id="' . $id . '" name="' . $name . '">';
		foreach ($options as $key => $label) {
			$select .= '<option value="' . $key . '"  ' . selected($value, $key, false) . '>';
			$select .= $label;
			$select .= '</option>';
		}
		$select .= '</select>';
		$select .= $this->end_wrap();
		echo $select;
	}

	public function input_category( $id, $name, $value, $title ) {
	    echo $this->start_wrap();
		?>
            <label for="<?php echo $id; ?>">
                <?php echo $title; ?>
                <?php
                wp_dropdown_categories( array(
                    'taxonomy'   => 'category',
                    'multiple'   => true,
                    'selected'   => implode(',', $value),
                    'hide_empty' => false,
                    'hierarchical' => 1,
                    'class' => 'widefat popular-posts-category',
                    'value_field' => 'term_id',
                    'show_count' => 1,
                    'name' => $name,
                    'id' => $id
                ) );
                ?>
            </label>
		<?php
        echo $this->end_wrap();
	}

	public function input_tag( $id, $name, $value, $title ) {
	    echo $this->start_wrap();
		?>
        <label for="<?php echo $id; ?>">
            <?php echo $title; ?>
            <select
                    class="widefat popular-posts-tag"
					id="<?php echo $id; ?>"
                    name="<?php echo $name; ?>[]"
                    multiple="multiple"
            >
				<?php
				$tags_arr = get_tags();
				foreach ($tags_arr as $tag) {
					$selected = in_array( $tag->term_id, $value) ? ' selected="selected" ' : '';
					?>
                    <option value="<?php echo $tag->term_id; ?>"<?php echo $selected; ?>><?php echo $tag->name; ?></option>
					<?php
				}
				?>
            </select>
        </label>
		<?php
		echo $this->end_wrap();
	}

	public function input_author( $id, $name, $value, $title ) {
		echo $this->start_wrap();
		?>
        <label for="<?php echo $id; ?>">
            <?php echo $title; ?>
            <select
                    class="widefat popular-posts-author"
					id="<?php echo $id; ?>"
                    name="<?php echo $name; ?>[]"
                    multiple="multiple"
            >
				<?php
				$authors_arr = get_users(array(
					'who' => 'authors',
					'has_published_posts' => true
				));
				foreach ($authors_arr as $author) {
					$selected = in_array( $author->ID, $value) ? ' selected="selected" ' : '';
					?>
                    <option value="<?php echo $author->ID; ?>"<?php echo $selected; ?>><?php echo $author->user_nicename; ?></option>
					<?php
				}
				?>
            </select>
        </label>
		<?php
        echo $this->end_wrap();;
	}

	public function input_post( $id, $name, $value, $title ) {
		echo $this->start_wrap();
		?>
        <label for="<?php echo $id; ?>">
            <?php echo $title; ?>
            <select
                    class="widefat popular-posts-post"
                    id="<?php echo $id; ?>"
                    name="<?php echo $name; ?>[]"
                    multiple="multiple"
            >
                <?php
                foreach ($value as $key => $val) {
                    $title = get_the_title($val);
                    ?>
                    <option value="<?php echo $val; ?>" selected="selected"><?php echo $title; ?></option>
                    <?php
                }
                ?>
            </select>
        </label>
		<?php
		echo $this->end_wrap();
	}


	public function input_template( $id, $name, $value, $title ) {
		$templates = $this->get_templates();
		$select = $this->start_wrap();
		$select .= '<label for="' . $id . '">' . $title . '</label>';
		$select .= '<select class="widefat popular-posts-template" id="' . $id . '" name="' . $name . '">';
		foreach ($templates as $val) {
			$select .= '<option value="' . $val . '"  ' . selected($value, $val, false) . '>';
			$select .= $val;
			$select .= '</option>';
		}
		$select .= '</select>';
		$select .= $this->end_wrap();
		echo $select;
	}

	public function input_thumbnail( $id, $name, $value, $title ) {
		$thumbnails = $this->list_thumbnail_sizes();
		$select = $this->start_wrap();
		$select .= '<label for="' . $id . '">' . $title . '</label>';
		$select .= '<select class="widefat popular-posts-thumbnail" id="' . $id . '" name="' . $name . '">';
		foreach ($thumbnails as $thumb) {
			$select .= '<option value="' . $thumb['value'] . '"  ' . selected($value, $thumb['value'], false) . '>';
			$select .= $thumb['label'];
			$select .= '</option>';
		}
		$select .= '</select>';
		$select .= $this->end_wrap();
		echo $select;
    }

	private function list_thumbnail_sizes() {
		global $_wp_additional_image_sizes;
		$sizes = array();
		$rSizes = array();
		foreach (get_intermediate_image_sizes() as $s) {
			$sizes[$s] = array(0, 0);
			if (in_array($s, array('thumbnail', 'medium', 'large'))) {
				$sizes[$s][0] = get_option($s . '_size_w');
				$sizes[$s][1] = get_option($s . '_size_h');
			} else {
				if (isset($_wp_additional_image_sizes) && isset($_wp_additional_image_sizes[$s]))
					$sizes[$s] = array($_wp_additional_image_sizes[$s]['width'], $_wp_additional_image_sizes[$s]['height'],);
			}
		}


		foreach ($sizes as $size => $atts) {
			array_push($rSizes, array(
				'label' => $size . ' ' . implode('x', $atts),
				'value' => $size
			));
		}
		return $rSizes;
	}

	private function get_templates() {
		$paths = array_filter(glob(POPULAR_DIR . 'templates/*'));
		$templates = [];
		foreach ($paths as $path) {
			$name = basename( $path );
			$templates[] = $name;
		}
		return $templates;
    }

	private function start_wrap() {
	    return '<p>';
	}
	private function end_wrap() {
		return '</p>';
	}

}
