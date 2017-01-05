<?php

/*
Class for routing pages.
> to hook class controllers and model;
> to create exemplars controllers and to call action;
*/
class Route
{

	static function start()
	{
		// default controller
		$controller_name = 'Main';
		$action_name = 'index';
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);

		// get name of controller
		if ( !empty($routes[1]) ) {	
			$controller_name = explode('?', $routes[1]);
			
			$model_name = 'Model_'.$controller_name[0];
			
			$controller_name = 'Controller_'.$controller_name[0];
			
			
		} else {
		    
		    $model_name = 'Model_'.$controller_name;
		    $controller_name = 'Controller_'.$controller_name;
		    
		}
		
		//get name action
		if ( !empty($routes[2]) ) {
			$action_name = $routes[2];
		}

		// add prefix
		$action_name = 'action_'.$action_name;


		// hook file contains model class 

		$model_file = strtolower($model_name).'.php';
		$model_path = "application/app/models/".$model_file;
		if(file_exists($model_path)) {
		     require_once "application/app/models/".$model_file;
		}

		// hook file contains controller class

		$controller_file = strtolower($controller_name) .'.php';
		$controller_path = "application/app/controllers/".$controller_file;
		if(file_exists($controller_path)) {
			require_once "application/app/controllers/".$controller_file;
		}
		else {
			/*
			if controller does not exist, to make redirect to Page 404
			*/
			Route::ErrorPage404();
		}
		
		// create controller
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action)) {
			// call action of controller
			$controller->$action();
		}
		else {
			//if action does not exist, to make redirect to Page 404
			Route::ErrorPage404();
		}
	
	}

	function ErrorPage404()
	{
                $host = 'http://'.$_SERVER['HTTP_HOST'].'/';
                header('HTTP/1.1 404 Not Found');
		header("Status: 404 Not Found");
		header('Location:'.$host.'404');
    }
    
}
