<?php
namespace Controllers;

use Models\User;

class SiteController extends Controller {

	public function action404() {
		http_response_code(404);
		echo "404 page";
	}

	public function actionIndex() {
		$this->render('index');
	}

	public function actionLogin() {
		$success = true;

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			if(isset($_POST['name']) && !empty($_POST['name']) && isset($_POST['password']) && !empty($_POST['password'])) {
				$user = new User;
		    	$success = $user->auth($_POST['name'], $_POST['password']);
				
				if($success)
					header("Location: /task/index");
			} else {
				$success = false;
			}
		}

		$this->render('login', ['display_error' => !$success]);
	}
	
	public function actionLogout() {
		session_start();
		unset($_SESSION['user']);
		session_destroy();

		header("Location: /");
	}	
	
}