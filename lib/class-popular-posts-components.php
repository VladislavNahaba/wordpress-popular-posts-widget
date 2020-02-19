<?php
class Popular_Posts_Components extends WP_Widget {

	public function input_checkbox( $id, $name, $value, $title ) {
		$checked = ( $value == 1 ) ? ' checked="checked"' : '';
		return $this->start_paragraph() . '<label for="' . $id . '"><input type="checkbox" id="' . $id . '" value="1" name="' . $name . '" ' . $checked . ' />' . $title . '</label>' . $this->end_paragraph();
	}

	public function input_text( $id, $name, $value, $title ) {
		return $this->start_paragraph() . '<label for="' . $id . '">' . $title . '<input class="widefat" type="text" id="' . $id . '" value="' . $value . '" name="' . $name . '"  /></label>' . $this->end_paragraph();
	}

	public function input_number( $id, $name, $value, $title ) {
		return $this->start_paragraph() . '<label for="' . $id . '">' . $title . '<input class="widefat" type="number" step="1" max="999999" min="0" id="' . $id . '" value="' . $value . '" name="' . $name . '"  /></label>' . $this->end_paragraph();
	}

	public function input_select( $id, $name, $value, $title, $options ) {
		$select = $this->start_paragraph();
		$select .= '<label for="' . $id . '">' . $title . '</label>';
		$select .= '</br>';
		$select .= '<select class="widefat" id="' . $id . '" name="' . $name . '">';
		foreach ($options as $key => $label) {
			$select .= '<option value="' . $key . '"  ' . selected($value, $key, false) . '>';
			$select .= $label;
			$select .= '</option>';
		}
		$select .= '</select>';
		$select .= $this->end_paragraph();
		return $select;
	}
	private function start_paragraph() {
		return '<p>';
	}
	private function end_paragraph() {
		return '</p>';
	}

}
