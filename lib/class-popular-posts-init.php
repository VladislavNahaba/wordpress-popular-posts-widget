<?php
class Popular_Posts_Init {
	private $options = array(
		'title' => array(
			'type' => 'text',
			'title' => 'Заголовок',
			'default' => 'Header'
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
				'date' => 'Date',
				'ID' => 'ID',
				'rand' => 'Random',
				'modified' => 'Modified',
				'type' => 'Type of post',
				'title' => 'Title',
				'author' => 'Author',
				'comment_count' => 'Comments count'
			),
			'default' => 'random'
		),
		'sort_order' => array(
			'type' => 'select',
			'title' => 'Порядок сортировки',
			'choices' => array(
				'ASC' => 'ASC',
				'DESC' => 'DESC',
			),
			'default' => 'desc'
		),
		'entity_type' => array(
			'type' => 'select',
			'title' => 'Тип выводимых постов',
			'choices' => array(
				'any' => 'Любые',
				'post' => 'Посты',
				'page' => 'Страницы',
			),
			'default' => 'post'
		),
//		'exclude_post' => array(
//			'type' => 'post',
//			'title' => 'Исключаемые посты',
//			'default' => ''
//		),
		'include_categories' => array(
			'type' => 'category',
			'title' => 'Включаемые категории',
			'default' => []
		),
		'exclude_categories' => array(
			'type' => 'category',
			'title' => 'Исключаемые категории',
			'default' => []
		),
		'include_tags' => array(
			'type' => 'tag',
			'title' => 'Включаемые тэги',
			'default' => []
		),
		'include_authors' => array(
			'type' => 'author',
			'title' => 'Включамые авторы',
			'default' => []
		),
	);

	public function get_options_params() {
		return $this->options;
	}
}
