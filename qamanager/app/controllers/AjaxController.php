<?php

class AjaxController extends ControllerBase
{

    public function indexAction()
    {

    }

    public function createAccountAction()
    {
    	$posts = $this->request->getPost();
    	$account = new UserAccount();
    	$this->db->begin();
    	if(!$account->save($posts)){
    		$this->db->rollback();
    		$err_msg = '';
    		foreach ($account->getMessages() as $value) {
    					$err_msg.=$value."\n";
    				}		
    		$this->_echoJson(0,$err_msg);
    		exit();
    	}
    	$this->db->commit();
    	$this->_echoJson(1,"User Account was created succesfully",$account);

    }
    public function createTeamAction()
    {
        $master_id = $this->session->get('user_id');

        $posts = $this->request->getPost();
        $posts['master_id'] = $master_id;
        $members_ids = $posts['members'];
        $team = new Team();
        $this->db->begin();
        if(!$team->save($posts)){
            $this->db->rollback();
            $err_msg = '';
            foreach ($team->getMessages() as $value) {
                        $err_msg.=$value."\n";
                    }       
            $this->_echoJson(0,$err_msg);
            exit();
        }
        $team_id = $team->id;
        for ($i=0; $i < sizeof($members_ids) ; $i++)
        { 
            $member = new TeamMembers();
            $member->member_id = $members_ids[$i];
            $member->team_id = $team_id;
            if(!$member->save()){
                $this->db->rollback();
                $err_msg = '';
                foreach ($member->getMessages() as $value) {
                            $err_msg.=$value."\n";
                        }       
                $this->_echoJson(0,$err_msg);
                exit();
            }   
        }

        $this->db->commit();
        $this->_echoJson(1,"Team was created succesfully",$posts);

    }
    public function createProjectAction()
    {
        $master_id = $this->session->get('user_id');

        $posts = $this->request->getPost();
        $posts['master_id'] = $master_id;
        $teams_ids = $posts['teams'];
        $project = new Projects();
        $this->db->begin();
        if(!$project->save($posts)){
            $this->db->rollback();
            $err_msg = '';
            foreach ($project->getMessages() as $value) {
                        $err_msg.=$value."\n";
                    }       
            $this->_echoJson(0,$err_msg);
            exit();
        }
        $project_id = $project->id;
        for ($i=0; $i < sizeof($teams_ids) ; $i++)
        { 
            $project_team = new ProjectTeam();
            $project_team->team_id = $teams_ids[$i];
            $project_team->project_id = $project_id;
            if(!$project_team->save()){
                $this->db->rollback();
                $err_msg = '';
                foreach ($project_team->getMessages() as $value) {
                            $err_msg.=$value."\n";
                        }       
                $this->_echoJson(0,$err_msg);
                exit();
            }   
        }

        $this->db->commit();
        $this->_echoJson(1,"Project was created succesfully",$posts);

    }
}	

