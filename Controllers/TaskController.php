<?php
namespace Controllers;
use Models\Task;

class TaskController extends Controller {

	public function actionList() {
		$this->renderTasksList('list');
	}

	public function actionListadmin() {
		$this->checkAuth(false);

		$this->renderTasksList('list-admin');
	}

	private function renderTasksList($view_name) {
		$task = new Task;
		$rows = $task->list($_GET['page'], $_GET['sort_by'], $_GET['sort_order']);
		$count = $task->count();

		$this->render($view_name, [
			'rows' => $rows, 
			'pagenum' => ceil($count / $task->page_size), 
			'page' => $_GET['page'] ? $_GET['page'] : 1, 
			'sort_by' => $_GET['sort_by'] ? $_GET['sort_by'] : null, 
			'sort_order' => $_GET['sort_order'] ? $_GET['sort_order'] : null, 
			'fields' => $task->fields
		], false);
	}


	public function actionCreate() {
		$task = new Task;

		$data = [];
		$errors = [];
		$valid = true;

		if(isset($_POST['name']) && !empty($_POST['name'])) {
			$data['name'] = $_POST['name'];
		} else {
			$errors['name'] = 'Обязательное поле';
			$valid = false;
		}

		if(isset($_POST['email']) && !empty($_POST['email'])) {
			if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
				$data['email'] = $_POST['email'];
			} else {
				$errors['email'] = 'Неправильный формат';
				$valid = false;	
			}
		} else {
			$errors['email'] = 'Обязательное поле';
			$valid = false;
		}

		if(isset($_POST['description']) && !empty($_POST['description'])) {
			$data['description'] = $_POST['description'];
		} else {
			$errors['description'] = 'Обязательное поле';
			$valid = false;
		}

		if($valid) {
			$task->create($data);
		} else {
			http_response_code(400);
			echo json_encode($errors);
		}	
	}

	public function actionIndex() {
		$this->checkAuth();	
		$this->render('index');
	}

	public function actionEdit() {
		$this->checkAuth();

		if(isset($_GET['id']) && !empty($_GET['id']) && is_numeric($_GET['id'])) {
			$id = $_GET['id'];
			$task = new Task;	
			$model = $task->get($id);
			
			if($model) {
				if ($_SERVER['REQUEST_METHOD'] === 'POST') {
					$valid = true;
					$data = []; 
					
					if(isset($_POST['description']) && !empty($_POST['description'])) {
						$data['description'] = $_POST['description'];

						if($_POST['description'] != $model['description']) {
							$data['is_edited'] = 1;
						}
					} else {
						$valid = false;
					}

					if(isset($_POST['is_completed']) && $_POST['is_completed'] == 'on') {
						$data['is_completed'] = 1;
					}

					if($valid) {
						$task->update($id, $data);
					}
				} else {
					$this->render('edit', [
						'model' => $model
					]);
				}
			}

		}

		header("Location: /task/index");
	}
}