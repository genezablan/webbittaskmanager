<?php

class ProjectsController extends ControllerBase
{

    public function indexAction()
    {	

    }	
    public function viewAction($name,$project_id)
    {
    	$this->view->setMainView('projects');
    	$this->view->setVar('page_content','projects/view');

    }
}

