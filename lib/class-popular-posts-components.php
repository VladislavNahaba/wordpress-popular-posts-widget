<?php
class Popular_Posts_Components extends WP_Widget {

	public function input_checkbox( $id, $name, $value, $title ) {
		$checked = ( $value == 1 ) ? ' checked="checked"' : '';
		return '<label for="' . $id . '"><input type="checkbox" id="' . $id . '" value="1" name="' . $name . '" ' . $checked . ' />' . $title . '</label>';
	}

	public function input_text( $id, $name, $value, $title ) {
		return '<label for="' . $id . '">' . $title . '<input class="widefat" type="text" id="' . $id . '" value="' . $value . '" name="' . $name . '"  /></label>';
	}

	public function input_number( $id, $name, $value, $title ) {
		return '<label for="' . $id . '">' . $title . '<input class="widefat" type="number" step="1" max="999999" min="0" id="' . $id . '" value="' . $value . '" name="' . $name . '"  /></label>';
	}

	public function input_select( $id, $name, $value, $title, $options ) {
		$select = '';
		$select .= '<label for="' . $id . '">' . $title . '</label>';
		$select .= '</br>';
		$select .= '<select class="widefat" id="' . $id . '" name="' . $name . '">';
		foreach ($options as $key => $label) {
			$select .= '<option value="' . $value . '"  ' . selected($value, $key, false) . '>';
			$select .= $label;
			$select .= '</option>';
		}
		$select .= '</select>';
		return $select;
	}
}
