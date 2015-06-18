<?php

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Assets\Manager as Assets;


class CssLoader extends Plugin
{
	public function AdminCss()
	{
		//$admin_js = $this->assets->collection('admin_js');
		// 	 $admin_js->addJs('js/admin_modal.js');		
	}
	public  function outputGlobalCss()
	{
		$scripts_header = $this->assets->collection('global_header_css');
		$scripts_header->addCss('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css',false);
		$scripts_header->addCss('css/select2.min.css');
		$scripts_header->addCss('css/main.css');
	}
	public function beforeDispatch(Event $event , Dispatcher $dispatcher)
	{
		$controller_name = $dispatcher->getControllerName();

		//LOAD GLOBAL JS
		if($controller_name != 'ajax' and $controller_name != 'posts')
		{
			$this->outputGlobalCss();
			switch($controller_name)
			{
				case "admin":
					$this->AdminCss();
				break;
			}

			
		}
	}
}