<?php
namespace Controllers;

class Controller {
	public $template = 'default';
	
	public function render($view_name, $data = [], $include_layout = true) {
        extract($data);

        ob_start();

        if($include_layout)
        	include( dirname(__DIR__) . _DS . 'Views' . _DS . 'layouts' . _DS . $this->template . _DS .'header.php');

        $reflection = new \ReflectionClass($this);

        $controller_shortname = $reflection->getShortName();

        include( dirname(__DIR__) . _DS . 'Views' . _DS . strtolower(str_replace('Controller', '', $controller_shortname)) . _DS .$view_name.'.php');
		
		if($include_layout)
			include( dirname(__DIR__) . _DS . 'Views' . _DS . 'layouts' . _DS . $this->template . _DS .'footer.php');

        $content = ob_get_contents();
        ob_end_clean();
        
        echo $content;

        exit;
    }

    protected function checkAuth($redirect = true) {
        session_start();
        session_regenerate_id();

        if(!$GLOBALS['is_admin'])
        {
            http_response_code(401);
            if($redirect)
                header("Location: /login");
            exit;
        }
    }
}