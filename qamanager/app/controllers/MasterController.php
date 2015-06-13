<?php

class MasterController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function homeAction()
    {
    	$this->view->setMainView("master");
    	$this->view->setVar('page_controller', 'master');
		$this->view->setVar('page_name', 'Home');
		$this->view->setVar('page_active', 'home');
		$this->view->setVar('page_content', 'master/home');
    	
    }
}

