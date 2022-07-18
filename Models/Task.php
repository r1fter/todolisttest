<?php
namespace Models;

class Task extends Model {
	protected $tablename = 'task';
	public $fields = [
		[
			'name' => 'name',
			'display_name' => 'Имя',
			'sortable' => true,
			'required' => true,
			'type' => 's',
		],
		[
			'name' => 'email',
			'display_name' => 'Email',
			'sortable' => true,
			'required' => true,
			'type' => 's',
		],
		[
			'name' => 'description',
			'display_name' => 'Описание',
			'sortable' => true,
			'required' => true,
			'type' => 's',
		],
		[
			'name' => 'is_completed',
			'display_name' => 'Завершена',
			'sortable' => false,
			'required' => false,
			'type' => 'i',
		]
	];
}