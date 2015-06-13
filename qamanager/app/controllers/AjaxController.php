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
        $this->db->commit();
        $this->_echoJson(1,"Team was created succesfully",$team);

    }
}	

