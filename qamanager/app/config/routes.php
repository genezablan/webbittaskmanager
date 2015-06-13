<?php

use Phalcon\Mvc\Router as PhRouter;

$di->set('router', function(){
	$router = new PhRouter(true);
	
	// load routes from the routes.php file
	
	$router->add('/team/:params', array(
		'controller'	=> 'team',
		'action'		=> 'view',
		'params'		=> 1
	));
	return $router;
});