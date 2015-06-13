<?php

use Phalcon\Acl;
use Phalcon\Events\Event;
use Phalcon\Mvc\User\Plugin;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Assets\Manager as Assets;


class SecurityPlugins extends Plugin
{
	
	public function beforeDispatch(Event $event , Dispatcher $dispatcher)
	{
		$user_id  = $this->session->get('user_id');
		$user_type_id = $this->session->get('user_type_id');
		$roles = "guest";
		$controller = $dispatcher->getControllerName();
		$action = $dispatcher->getActionName();
		if($user_id)	
		{	
			switch ($user_type_id)
			{
				case 1:
					$roles = "admin";
					break;
				case 2:
					$roles = "master";
					break;
			}
		}
		$is_allowed = $this->isAllowed($roles,$controller,$action);
		//var_dump("Role: ".$roles.' Controller: '.$controller.' Action: '.$action);
		//var_dump($is_allowed); die;
		
		/*if(!$is_allowed)
		{
			$this->flash->error("You don't have access to this module");
            $dispatcher->forward(
                array(
                    'controller' => 'index',
                    'action' => 'index'
                )
            );
            return false;

		}*/
		
	}

	public function isAllowed($roles,$controller,$action)
	{
		
		$is_allowed = false;

		$role_list = array(
				"guest"=>array(
							"index" => array("index"),
							"post" => array("login"),
							"team" => array("index")
						),
				"admin"=>array(
							"index" => array("index"),
							"post" => array("login"),
							"admin" => array("home","logout"),
							"ajax" => array("createAccount"),
							"team" => array("index")
						),
				"master"=>array(
							"index" => array("index"),
							"post" => array("login"),
							"master" =>array("home","logout"),
							"ajax" => array("createTeam"),
							"team" => array("index","view")
						)
			);
		
		
			
		foreach ($role_list[$roles] as $key => $value) {
			if($controller == $key){
				$is_allowed = in_array($action,$role_list[$roles][$controller]);
			}
		}
		
		return $is_allowed;

	}

}