<?php 
class Router {

	public function redirect404() {
		header("Location: /404");
		exit;
	}

	public function run($path) {
		if(!empty($_GET)) {
			$path = explode('?', $path)[0];
		}

		$path_items = explode('/', trim($path,'/'));

		switch(count($path_items)) {
			case 1:
				$controller_name = 'SiteController';
				
				if(empty($path_items[0])) {
					$method_name = 'actionIndex';
				} else {
					$method_name = 'action'.ucfirst(strtolower($path_items[0]));
				}
				break;

			case 2:
				$controller_name = ucfirst(strtolower($path_items[0])).'Controller';
				$method_name = 'action'.ucfirst(strtolower($path_items[1]));
				break;

			default:
				$this->redirect404();
		}

		$controller_name = 'Controllers\\'.$controller_name;

		if(class_exists($controller_name) && method_exists($controller_name, $method_name)) {
			$controller = new $controller_name;
		} else {
			$this->redirect404();
		}

		$controller->$method_name();
	}
}