<?php
class Popular_Posts_Init {
	private $options = array(
		'title' => array(
			'type' => 'text',
			'title' => 'Заголовок',
			'default' => 'Header'
		),
		'title_max_length' => array(
			'type' => 'number',
			'title' => 'Максимальная длина заголовка',
			'default' => '50'
		),
		'date' => array(
			'type' => 'checkbox',
			'title' => 'Показывать дату',
			'default' => ''
		),
		'description' => array(
			'type' => 'checkbox',
			'title' => 'Показывать описание поста',
			'default' => ''
		),
		'description_length' => array(
			'type' => 'number',
			'title' => 'Длина описания поста',
			'default' => 0
		),
		'amount' => array(
			'type' => 'number',
			'title' => 'Кол-во постов',
			'default' => 5
		),
		'sort' => array(
			'type' => 'select',
			'title' => 'Сортировка',
			'choices' => array(
				'asc' => 'asc',
				'desc' => 'desc',
			),
			'default' => 'date'
		),
		'sort_order' => array(
			'type' => 'select',
			'title' => 'Порядок сортировки',
			'choices' => array(
				'date' => 'Date',
				'id' => 'ID',
				'random' => 'Random'
			),
			'default' => 'asc'
		),
		'images' => array(
			'type' => 'checkbox',
			'title' => 'Изображения',
			'default' => ''
		)
	);

	public function get_options_params() {
		return $this->options;
	}
}
