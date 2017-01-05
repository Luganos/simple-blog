<?php

class Controller {
	
	public $model;
        public $data;
	public $view;
	
	public function __construct()
	{
		$this->view = new View();
	}
	
	/* Redirect to certain link
	 * @return string
	 */
        public function redirect($path) {
	    
	    if (!is_string($path)) {
		$path = 'controller_404';
	    }
	
	    $host  = $_SERVER['HTTP_HOST'];
            $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
            header("Location: http://$host$uri/$path");
        }
	 
}
