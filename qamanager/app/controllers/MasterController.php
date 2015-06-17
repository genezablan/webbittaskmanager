<?php

class MasterController extends ControllerBase
{
    public function initTeams()
    {
        $master_id = $this->session->get('user_id');
        $teams = Team::listTeams($master_id);
        $this->view->setVar('teams',$teams);
    }
    public function initProjects()
    {
        $master_id = $this->session->get('user_id');
        $projects = Projects::listProjects($master_id);
        $this->view->setVar('projects',$projects);
    }
    public function initMembers()
    {
        $members = UserAccount::find(array(
                "conditions"=>"user_type_id = 3"
            ));
        $this->view->setVar('members',$members);
    }
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
    	$this->initTeams();
        $this->initMembers();
        $this->initProjects();


    }
}

