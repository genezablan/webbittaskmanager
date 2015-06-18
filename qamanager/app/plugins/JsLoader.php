<?php

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Assets\Manager as Assets;


class JsLoader extends Plugin
{
	public function MasterJs()
	{
		$master_js = $this->assets->collection('master_js');
		$master_js->addJs('js/master_modal.js');		
	}
	public function AdminJs()
	{
		$admin_js = $this->assets->collection('admin_js');
		$admin_js->addJs('js/admin_modal.js');		
	}
	public function ProjectJs()
	{
		$project_js = $this->assets->collection('project_js');
		$project_js->addJs('js/project_modal.js');			
	}
	public function outputGlobalFooterJs()
	{
		$scripts_footer = $this->assets->collection('global_footer_js');

	}

	public  function outputGlobalJs()
	{
		$scripts_header = $this->assets->collection('global_header_js');
		$scripts_header->addJs('https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js',false); 
		$scripts_header->addJs('http://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js',false);
		$scripts_header->addJs('js/select2.full.min.js');
		$scripts_header->addJs('js/validator.js');
		$scripts_header->addJs('js/model/user_account.js');
		$scripts_header->addJs('js/model/team.js');
		$scripts_header->addJs('js/model/projects.js');
		$scripts_header->addJs('js/prototypes.js');
		$scripts_header->addJs('js/global_variables.js');
		$scripts_header->join(true);
		$scripts_header->setTargetPath('public/production/header_final.js');
		$scripts_header->setTargetUri('production/final.js');
	}
	public function beforeDispatch(Event $event , Dispatcher $dispatcher)
	{
		$controller_name = $dispatcher->getControllerName();

		//LOAD GLOBAL JS
		if($controller_name != 'ajax' and $controller_name != 'posts')
		{
			$this->outputGlobalJs();
			$this->outputGlobalFooterJs();
			switch($controller_name)
			{
				case "admin":
					$this->AdminJs();
				break;
				case "master":
					$this->MasterJs();
				break;
				case "projects":
					$this->ProjectJs();
				break;
			}

			
		}
	}
}